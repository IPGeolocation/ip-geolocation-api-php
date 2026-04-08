<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

/**
 * Main client for the IPGeolocation.io IP Location API.
 *
 * Homepage: https://ipgeolocation.io
 * IP Location API: https://ipgeolocation.io/ip-location-api.html
 * Documentation: https://ipgeolocation.io/documentation/ip-location-api.html
 */
final class IpGeolocationClient
{
    private readonly IpGeolocationClientConfig $config;
    private readonly HttpTransport $transport;
    private readonly bool $owns_transport;
    private bool $closed = false;

    /**
     * @param IpGeolocationClientConfig|array<string, mixed> $config
     */
    public function __construct(IpGeolocationClientConfig|array $config, ?HttpTransport $transport = null)
    {
        $this->config = $config instanceof IpGeolocationClientConfig
            ? $config
            : new IpGeolocationClientConfig(
                api_key: $config['api_key'] ?? null,
                request_origin: $config['request_origin'] ?? null,
                base_url: $config['base_url'] ?? IpGeolocationClientConfig::DEFAULT_BASE_URL,
                connect_timeout: $config['connect_timeout'] ?? IpGeolocationClientConfig::DEFAULT_CONNECT_TIMEOUT,
                read_timeout: $config['read_timeout'] ?? IpGeolocationClientConfig::DEFAULT_READ_TIMEOUT
            );

        $this->transport = $transport ?? new GuzzleTransport();
        $this->owns_transport = $transport === null;
    }

    public static function defaultUserAgent(): string
    {
        return 'ipgeolocation-php-sdk/' . Version::VERSION;
    }

    /**
     * @return ApiResponse<IpGeolocationResponse>
     */
    public function lookupIpGeolocation(LookupIpGeolocationRequest|array|null $request = null): ApiResponse
    {
        $this->ensureOpen();
        $typedRequest = $this->toLookupRequest($request);
        $this->validateLookupRequestBase();
        SerDe::validateJsonOutput($typedRequest->output);

        [$response, $durationMs] = $this->executeWithMetrics($this->buildLookupHttpRequest($typedRequest));
        if (!$this->successStatus($response->status_code)) {
            throw SerDe::toApiException($response->status_code, $response->body);
        }

        return new ApiResponse(
            data: SerDe::parseSingleLookup($response->body),
            metadata: SerDe::toMetadata($response->status_code, $durationMs, $response->headers)
        );
    }

    /**
     * @return ApiResponse<string>
     */
    public function lookupIpGeolocationRaw(LookupIpGeolocationRequest|array|null $request = null): ApiResponse
    {
        $this->ensureOpen();
        $typedRequest = $this->toLookupRequest($request);
        $this->validateLookupRequestBase();

        [$response, $durationMs] = $this->executeWithMetrics($this->buildLookupHttpRequest($typedRequest));
        if (!$this->successStatus($response->status_code)) {
            throw SerDe::toApiException($response->status_code, $response->body);
        }

        return new ApiResponse(
            data: $response->body,
            metadata: SerDe::toMetadata($response->status_code, $durationMs, $response->headers)
        );
    }

    /**
     * @return ApiResponse<array<int, BulkLookupResult>>
     */
    public function bulkLookupIpGeolocation(BulkLookupIpGeolocationRequest|array $request): ApiResponse
    {
        $this->ensureOpen();
        $typedRequest = $this->toBulkRequest($request);
        $this->validateBulkRequestBase();
        SerDe::validateJsonOutput($typedRequest->output);

        [$response, $durationMs] = $this->executeWithMetrics($this->buildBulkHttpRequest($typedRequest));
        if (!$this->successStatus($response->status_code)) {
            throw SerDe::toApiException($response->status_code, $response->body);
        }

        return new ApiResponse(
            data: SerDe::parseBulkLookup($response->body),
            metadata: SerDe::toMetadata($response->status_code, $durationMs, $response->headers)
        );
    }

    /**
     * @return ApiResponse<string>
     */
    public function bulkLookupIpGeolocationRaw(BulkLookupIpGeolocationRequest|array $request): ApiResponse
    {
        $this->ensureOpen();
        $typedRequest = $this->toBulkRequest($request);
        $this->validateBulkRequestBase();

        [$response, $durationMs] = $this->executeWithMetrics($this->buildBulkHttpRequest($typedRequest));
        if (!$this->successStatus($response->status_code)) {
            throw SerDe::toApiException($response->status_code, $response->body);
        }

        return new ApiResponse(
            data: $response->body,
            metadata: SerDe::toMetadata($response->status_code, $durationMs, $response->headers)
        );
    }

    public function close(): void
    {
        if ($this->closed) {
            return;
        }

        $this->closed = true;
        if ($this->owns_transport) {
            $this->transport->close();
        }
    }

    private function ensureOpen(): void
    {
        if ($this->closed) {
            throw new ValidationException('client is closed');
        }
    }

    private function validateLookupRequestBase(): void
    {
        if ($this->config->api_key === null && $this->config->request_origin === null) {
            throw new ValidationException('single lookup requires api_key or request_origin in client config');
        }
    }

    private function validateBulkRequestBase(): void
    {
        if ($this->config->api_key === null) {
            throw new ValidationException('bulk lookup requires api_key in client config');
        }
    }

    private function toLookupRequest(LookupIpGeolocationRequest|array|null $request): LookupIpGeolocationRequest
    {
        if ($request === null) {
            return new LookupIpGeolocationRequest();
        }

        if ($request instanceof LookupIpGeolocationRequest) {
            return $request;
        }

        return new LookupIpGeolocationRequest(
            ip: $request['ip'] ?? null,
            lang: $request['lang'] ?? null,
            include: $request['include'] ?? [],
            fields: $request['fields'] ?? [],
            excludes: $request['excludes'] ?? [],
            user_agent: $request['user_agent'] ?? null,
            headers: $request['headers'] ?? [],
            output: $request['output'] ?? ResponseFormat::JSON
        );
    }

    private function toBulkRequest(BulkLookupIpGeolocationRequest|array $request): BulkLookupIpGeolocationRequest
    {
        if ($request instanceof BulkLookupIpGeolocationRequest) {
            return $request;
        }

        return new BulkLookupIpGeolocationRequest(
            ips: $request['ips'] ?? [],
            lang: $request['lang'] ?? null,
            include: $request['include'] ?? [],
            fields: $request['fields'] ?? [],
            excludes: $request['excludes'] ?? [],
            user_agent: $request['user_agent'] ?? null,
            headers: $request['headers'] ?? [],
            output: $request['output'] ?? ResponseFormat::JSON
        );
    }

    private function buildLookupHttpRequest(LookupIpGeolocationRequest $request): HttpRequestData
    {
        $output = $request->output;
        $query = SerDe::buildQuery([
            'apiKey' => $this->config->api_key,
            'ip' => $request->ip,
            'lang' => $request->lang,
            'include' => $request->include === [] ? null : implode(',', $request->include),
            'fields' => $request->fields === [] ? null : implode(',', $request->fields),
            'excludes' => $request->excludes === [] ? null : implode(',', $request->excludes),
            'output' => $output,
        ]);

        $headers = SerDe::mergeHeaders(
            $request->headers,
            $this->config->request_origin === null ? null : ['Origin' => [$this->config->request_origin]],
            [
                'User-Agent' => SerDe::resolveUserAgentHeader(
                    $request->user_agent,
                    $request->headers,
                    self::defaultUserAgent()
                ),
                'Accept' => [$output === ResponseFormat::XML ? 'application/xml' : 'application/json'],
            ]
        );

        return new HttpRequestData(
            url: $this->config->base_url . '/v3/ipgeo' . $query,
            method: 'GET',
            headers: $headers,
            body: null,
            connect_timeout: $this->config->connect_timeout,
            read_timeout: $this->config->read_timeout
        );
    }

    private function buildBulkHttpRequest(BulkLookupIpGeolocationRequest $request): HttpRequestData
    {
        $output = $request->output;
        $query = SerDe::buildQuery([
            'apiKey' => $this->config->api_key,
            'lang' => $request->lang,
            'include' => $request->include === [] ? null : implode(',', $request->include),
            'fields' => $request->fields === [] ? null : implode(',', $request->fields),
            'excludes' => $request->excludes === [] ? null : implode(',', $request->excludes),
            'output' => $output,
        ]);

        try {
            $payload = json_encode(['ips' => $request->ips], JSON_THROW_ON_ERROR);
        } catch (\JsonException $error) {
            throw new SerializationException('Failed to serialize bulk lookup request body', $error);
        }

        $headers = SerDe::mergeHeaders(
            $request->headers,
            $this->config->request_origin === null ? null : ['Origin' => [$this->config->request_origin]],
            [
                'User-Agent' => SerDe::resolveUserAgentHeader(
                    $request->user_agent,
                    $request->headers,
                    self::defaultUserAgent()
                ),
                'Accept' => [$output === ResponseFormat::XML ? 'application/xml' : 'application/json'],
                'Content-Type' => ['application/json'],
            ]
        );

        return new HttpRequestData(
            url: $this->config->base_url . '/v3/ipgeo-bulk' . $query,
            method: 'POST',
            headers: $headers,
            body: $payload,
            connect_timeout: $this->config->connect_timeout,
            read_timeout: $this->config->read_timeout
        );
    }

    /**
     * @return array{HttpResponseData, int}
     */
    private function executeWithMetrics(HttpRequestData $request): array
    {
        $startedAt = microtime(true);
        $response = $this->transport->sendRequest($request);
        $durationMs = (int) floor((microtime(true) - $startedAt) * 1000);

        return [$response, max($durationMs, 0)];
    }

    private function successStatus(int $statusCode): bool
    {
        return intdiv($statusCode, 100) === 2;
    }
}
