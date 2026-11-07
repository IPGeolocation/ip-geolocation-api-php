<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use Ipgeolocation\Sdk\ApiException;
use Ipgeolocation\Sdk\BulkLookupError;
use Ipgeolocation\Sdk\BulkLookupIpGeolocationRequest;
use Ipgeolocation\Sdk\HttpResponseData;
use Ipgeolocation\Sdk\IpGeolocationClient;
use Ipgeolocation\Sdk\IpGeolocationClientConfig;
use Ipgeolocation\Sdk\LookupIpGeolocationRequest;
use Ipgeolocation\Sdk\SerializationException;
use Ipgeolocation\Sdk\SerDe;
use Ipgeolocation\Sdk\Test\Support\FakeTransport;
use Ipgeolocation\Sdk\TransportException;
use Ipgeolocation\Sdk\ValidationException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class HardeningTest extends TestCase
{
    private const KEY = 'example key+/"&value';

    private function client(int $status, string $body, ?FakeTransport &$transport = null): IpGeolocationClient
    {
        $transport = new FakeTransport();
        $transport->push(new HttpResponseData($status, $body, []));
        return new IpGeolocationClient(['api_key' => self::KEY], $transport);
    }

    public function testArabicAndAuthenticationForBothRequests(): void
    {
        $this->client(200, '{"ip":"8.8.8.8"}', $single)->lookupIpGeolocation(new LookupIpGeolocationRequest(ip: '8.8.8.8', lang: ' AR '));
        $this->client(200, '[{"ip":"8.8.8.8"}]', $bulk)->bulkLookupIpGeolocation(new BulkLookupIpGeolocationRequest(['8.8.8.8'], lang: 'ar'));
        foreach ([$single, $bulk] as $transport) {
            parse_str(parse_url($transport->requests[0]->url, PHP_URL_QUERY), $query);
            self::assertSame(self::KEY, $query['apiKey']);
            self::assertSame('ar', $query['lang']);
        }
    }

    public function testPrintingSettingsDoesNotChangeTheStoredKey(): void
    {
        $config = new IpGeolocationClientConfig(api_key: self::KEY);
        foreach ([$config, new IpGeolocationClient($config)] as $value) {
            ob_start();
            var_dump($value);
            $dump = ob_get_clean();
            self::assertStringNotContainsString(self::KEY, $dump . print_r($value, true));
            self::assertStringContainsString('[REDACTED]', $dump);
        }
        foreach ([false, true] as $keepNulls) {
            self::assertSame('[REDACTED]', $config->toArray($keepNulls)['api_key']);
        }
        self::assertSame('[REDACTED]', json_decode(json_encode($config), true)['api_key']);
        self::assertSame(self::KEY, $config->api_key);
    }

    #[DataProvider('errorBodies')]
    public function testHttpErrorsKeepStatusAndHideTheKey(string $body): void
    {
        $previous = ini_set('zend.exception_ignore_args', '0');
        try {
            $this->client(429, $body)->lookupIpGeolocation(['ip' => '8.8.8.8']);
            self::fail('Expected an HTTP error');
        } catch (ApiException $error) {
            self::assertSame(429, $error->status_code);
            self::assertInstanceOf(\Ipgeolocation\Sdk\RateLimitException::class, $error);
            foreach ([self::KEY, rawurlencode(self::KEY), urlencode(self::KEY)] as $secret) {
                self::assertStringNotContainsString($secret, (string) $error . print_r($error, true));
            }
            foreach ($error->getTrace() as $frame) {
                self::assertArrayNotHasKey('args', $frame);
            }
        } finally {
            ini_set('zend.exception_ignore_args', $previous);
        }
    }

    public static function errorBodies(): array
    {
        return array_map(static fn ($body) => [$body], [
            json_encode(['message' => self::KEY]),
            json_encode(['error' => ['message' => rawurlencode(self::KEY)]]),
            json_encode(['message' => ['invalid' => self::KEY]]),
            '<html>' . self::KEY . '</html>', '', 'null', '[]', 'false',
            '{"message":123}', '{"message":false}', '{"message":null}',
            str_repeat('x', 505) . self::KEY,
        ]);
    }

    public function testTransportErrorsDoNotRetainTheRequestOrCause(): void
    {
        $previous = ini_set('zend.exception_ignore_args', '0');
        try {
            $transport = new FakeTransport();
            $transport->push(new ConnectException('Failed ' . rawurlencode(self::KEY), new Request('GET', 'https://example.test/?apiKey=' . rawurlencode(self::KEY))));
            (new IpGeolocationClient(['api_key' => self::KEY], $transport))->lookupIpGeolocation();
            self::fail('Expected transport error');
        } catch (TransportException $error) {
            self::assertNull($error->getPrevious());
            self::assertNull($error->cause);
            self::assertStringNotContainsString(self::KEY, print_r($error, true));
            self::assertStringNotContainsString(rawurlencode(self::KEY), (string) $error . print_r($error, true));
        } finally {
            ini_set('zend.exception_ignore_args', $previous);
        }
    }

    public function testValidationTraceDoesNotRetainConfigArguments(): void
    {
        $previous = ini_set('zend.exception_ignore_args', '0');
        try {
            new IpGeolocationClientConfig(api_key: self::KEY, read_timeout: 0);
            self::fail('Expected validation error');
        } catch (ValidationException $error) {
            self::assertStringNotContainsString(self::KEY, print_r($error, true));
        } finally {
            ini_set('zend.exception_ignore_args', $previous);
        }
    }

    public function testParseErrorsDoNotRetainTheOriginalBody(): void
    {
        $previous = ini_set('zend.exception_ignore_args', '0');
        try {
            $this->client(200, '{"ip":' . json_encode(self::KEY))->lookupIpGeolocation();
            self::fail('Expected a parse error');
        } catch (SerializationException $error) {
            self::assertNull($error->getPrevious());
            self::assertNull($error->cause);
            self::assertStringNotContainsString(self::KEY, print_r($error, true));
        } finally {
            ini_set('zend.exception_ignore_args', $previous);
        }
    }

    public function testInvalidInputKeepsItsErrorType(): void
    {
        foreach ([['headers' => ['X-Test' => 1]], ['fields' => [1]]] as $request) {
            try {
                $this->client(200, '{}')->lookupIpGeolocation($request);
                self::fail('Expected a type error');
            } catch (\TypeError $error) {
                self::assertStringNotContainsString(self::KEY, print_r($error, true));
            }
        }
    }

    public function testConstructorTypeErrorsDoNotRetainSettings(): void
    {
        $previous = ini_set('zend.exception_ignore_args', '0');
        try {
            new IpGeolocationClient(['api_key' => self::KEY, 'read_timeout' => []]);
            self::fail('Expected a type error');
        } catch (\TypeError $error) {
            self::assertStringNotContainsString(self::KEY, print_r($error, true));
        } finally {
            ini_set('zend.exception_ignore_args', $previous);
        }
    }

    public function testOnlyTypedBulkErrorMessagesAreRedacted(): void
    {
        $body = json_encode([['ip' => self::KEY], ['error' => ['message' => self::KEY]]]);
        $typed = $this->client(200, $body)->bulkLookupIpGeolocation(['ips' => ['8.8.8.8', '1.1.1.1']]);
        self::assertSame(self::KEY, $typed->data[0]->data->ip);
        self::assertInstanceOf(BulkLookupError::class, $typed->data[1]);
        self::assertSame('[REDACTED]', $typed->data[1]->error->message);
        self::assertSame($body, $this->client(200, $body)->bulkLookupIpGeolocationRaw(['ips' => ['8.8.8.8', '1.1.1.1']])->data);
        self::assertSame(self::KEY, $this->client(200, json_encode(['ip' => self::KEY]))->lookupIpGeolocation()->data->ip);
    }

    #[DataProvider('invalidBulkBodies')]
    public function testInvalidBulkResultsAreRejectedButRawResultsAreUnchanged(string $body): void
    {
        self::assertSame($body, $this->client(200, $body)->bulkLookupIpGeolocationRaw(['ips' => ['8.8.8.8']])->data);
        $this->expectException(SerializationException::class);
        $this->client(200, $body)->bulkLookupIpGeolocation(['ips' => ['8.8.8.8']]);
    }

    public static function invalidBulkBodies(): array
    {
        return array_map(static fn ($body) => [$body], ['[]', '[{},{}]', '[[]]', '[null]', '[false]', '[1]', '["value"]', '{}', '{"0":{}}', '[{"location":[]}]', '[{"message":[]}]', '[{"ip":1}]', '[{"ip":"bad\\uD800"}]']);
    }

    public function testFilteredEmptyObjectsAndDuplicateInputsKeepTheirRows(): void
    {
        $rows = $this->client(200, '[{},{}]')->bulkLookupIpGeolocation(['ips' => ['8.8.8.8', '8.8.8.8']])->data;
        self::assertCount(2, $rows);
        self::assertTrue($rows[0]->isSuccess());
        self::assertSame([], $rows[0]->data->toArray());
    }

    public function testAllNewFieldsAreParsed(): void
    {
        $network = ['is_cdn' => false, 'cdn_provider_name' => 'Example'];
        $security = ['proxy_days_seen_30d' => 3, 'proxy_days_seen_7d' => 1, 'proxy_provider_count_30d' => 2, 'bot_confidence_score' => 0.5, 'bot_operator_name' => 'Example', 'bot_type' => 'crawler', 'is_known_good_bot' => false, 'bot_last_seen' => '2026-11-06', 'is_corporate_gateway' => true, 'corporate_gateway_type' => 'sase', 'corporate_gateway_provider_name' => 'Example'];
        $result = SerDe::parseSingleLookup(json_encode(['network' => $network, 'security' => $security]));
        foreach ($network as $key => $value) {
            self::assertSame($value, $result->network->$key);
        }
        foreach ($security as $key => $value) {
            self::assertSame(is_int($value) ? (float) $value : $value, $result->security->$key);
        }
    }

    #[DataProvider('invalidHeaders')]
    public function testInvalidHeadersAreRejectedBeforeTransport(array $request): void
    {
        $this->expectException(ValidationException::class);
        new LookupIpGeolocationRequest(...$request);
    }

    public static function invalidHeaders(): array
    {
        return [[['headers' => ['Bad Name' => 'x']]], [['headers' => ['Bad:Name' => 'x']]], [['headers' => ["X-Test\r\n" => 'x']]], [['headers' => ['X-Test' => "\nx"]]], [['headers' => ['X-Test' => "x\0y"]]], [['user_agent' => "x\r\nX-Test: injected"]]];
    }
}
