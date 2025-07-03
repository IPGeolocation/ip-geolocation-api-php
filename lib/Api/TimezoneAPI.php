<?php
/**
 * TimezoneAPI
 * PHP version 8.1
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 */

/**
 * IPGeolocation.io - IP intelligence products
 *
 * Ipgeolocation provides a set of APIs to make ip based decisions.
 */



namespace Ipgeolocation\Sdk\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Ipgeolocation\Sdk\ApiException;
use Ipgeolocation\Sdk\Configuration;
use Ipgeolocation\Sdk\FormDataProcessor;
use Ipgeolocation\Sdk\HeaderSelector;
use Ipgeolocation\Sdk\ObjectSerializer;

/**
 * TimezoneAPI Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 */
class TimezoneAPI
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'getTimezoneInfo' => [
            'application/json',
        ],
    ];

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the ipgeoapi spec
     */
    public function __construct(
        ?ClientInterface $client = null,
        ?Configuration $config = null,
        ?HeaderSelector $selector = null,
        int $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: Configuration::getDefaultConfiguration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getTimezoneInfo
     *
     * Timezone information details
     *
     * @param  string|null $tz pass a valid time zone name as a query parameter tz to get the time zone information. (optional)
     * @param  string|null $location pass any address of a location as the query parameter location to get the time zone information. (optional)
     * @param  float|null $lat pass the latitude of a location as query parameters to get the time zone information. (optional)
     * @param  float|null $long pass the longitude of a location as query parameters to get the time zone information. (optional)
     * @param  string|null $ip You can pass any IPv4 or IPv6 address as a query parameter ip to get the regional timezone information. (optional)
     * @param  string|null $iata_code pass any 3 letter IATA code as a query paramter iata_code to get the comprehensive airport details along with the time zone information, in which that airport exists. (optional)
     * @param  string|null $icao_code pass any 4 letter ICAO code as a query paramter icao_code to get the comprehensive airport details along with the time zone information, in which that airport exists. (optional)
     * @param  string|null $lo_code pass any 5 letter UNLOCODE as a query paramter lo_code to get the comprehensive lo code/city details along with the time zone information of the concerned city. (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTimezoneInfo'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Ipgeolocation\Sdk\\Model\TimeZoneDetailedResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse
     */
    public function getTimezoneInfo($tz = null, $location = null, $lat = null, $long = null, $ip = null, $iata_code = null, $icao_code = null, $lo_code = null, $output = null, $lang = null, string $contentType = self::contentTypes['getTimezoneInfo'][0])
    {
        list($response) = $this->getTimezoneInfoWithHttpInfo($tz, $location, $lat, $long, $ip, $iata_code, $icao_code, $lo_code, $output, $lang, $contentType);
        return $response;
    }

    /**
     * Operation getTimezoneInfoWithHttpInfo
     *
     * Timezone information details
     *
     * @param  string|null $tz pass a valid time zone name as a query parameter tz to get the time zone information. (optional)
     * @param  string|null $location pass any address of a location as the query parameter location to get the time zone information. (optional)
     * @param  float|null $lat pass the latitude of a location as query parameters to get the time zone information. (optional)
     * @param  float|null $long pass the longitude of a location as query parameters to get the time zone information. (optional)
     * @param  string|null $ip You can pass any IPv4 or IPv6 address as a query parameter ip to get the regional timezone information. (optional)
     * @param  string|null $iata_code pass any 3 letter IATA code as a query paramter iata_code to get the comprehensive airport details along with the time zone information, in which that airport exists. (optional)
     * @param  string|null $icao_code pass any 4 letter ICAO code as a query paramter icao_code to get the comprehensive airport details along with the time zone information, in which that airport exists. (optional)
     * @param  string|null $lo_code pass any 5 letter UNLOCODE as a query paramter lo_code to get the comprehensive lo code/city details along with the time zone information of the concerned city. (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTimezoneInfo'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Ipgeolocation\Sdk\\Model\TimeZoneDetailedResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getTimezoneInfoWithHttpInfo($tz = null, $location = null, $lat = null, $long = null, $ip = null, $iata_code = null, $icao_code = null, $lo_code = null, $output = null, $lang = null, string $contentType = self::contentTypes['getTimezoneInfo'][0])
    {
        $request = $this->getTimezoneInfoRequest($tz, $location, $lat, $long, $ip, $iata_code, $icao_code, $lo_code, $output, $lang, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\Ipgeolocation\Sdk\\Model\TimeZoneDetailedResponse',
                        $request,
                        $response,
                    );
                case 400:
                    return $this->handleResponseWithDataType(
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $request,
                        $response,
                    );
                case 401:
                    return $this->handleResponseWithDataType(
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $request,
                        $response,
                    );
                case 404:
                    return $this->handleResponseWithDataType(
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $request,
                        $response,
                    );
                case 405:
                    return $this->handleResponseWithDataType(
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $request,
                        $response,
                    );
                case 429:
                    return $this->handleResponseWithDataType(
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $request,
                        $response,
                    );
                case 499:
                    return $this->handleResponseWithDataType(
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $request,
                        $response,
                    );
                case 500:
                    return $this->handleResponseWithDataType(
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\Ipgeolocation\Sdk\\Model\TimeZoneDetailedResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\TimeZoneDetailedResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 405:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 499:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\ErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation getTimezoneInfoAsync
     *
     * Timezone information details
     *
     * @param  string|null $tz pass a valid time zone name as a query parameter tz to get the time zone information. (optional)
     * @param  string|null $location pass any address of a location as the query parameter location to get the time zone information. (optional)
     * @param  float|null $lat pass the latitude of a location as query parameters to get the time zone information. (optional)
     * @param  float|null $long pass the longitude of a location as query parameters to get the time zone information. (optional)
     * @param  string|null $ip You can pass any IPv4 or IPv6 address as a query parameter ip to get the regional timezone information. (optional)
     * @param  string|null $iata_code pass any 3 letter IATA code as a query paramter iata_code to get the comprehensive airport details along with the time zone information, in which that airport exists. (optional)
     * @param  string|null $icao_code pass any 4 letter ICAO code as a query paramter icao_code to get the comprehensive airport details along with the time zone information, in which that airport exists. (optional)
     * @param  string|null $lo_code pass any 5 letter UNLOCODE as a query paramter lo_code to get the comprehensive lo code/city details along with the time zone information of the concerned city. (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTimezoneInfo'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTimezoneInfoAsync($tz = null, $location = null, $lat = null, $long = null, $ip = null, $iata_code = null, $icao_code = null, $lo_code = null, $output = null, $lang = null, string $contentType = self::contentTypes['getTimezoneInfo'][0])
    {
        return $this->getTimezoneInfoAsyncWithHttpInfo($tz, $location, $lat, $long, $ip, $iata_code, $icao_code, $lo_code, $output, $lang, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTimezoneInfoAsyncWithHttpInfo
     *
     * Timezone information details
     *
     * @param  string|null $tz pass a valid time zone name as a query parameter tz to get the time zone information. (optional)
     * @param  string|null $location pass any address of a location as the query parameter location to get the time zone information. (optional)
     * @param  float|null $lat pass the latitude of a location as query parameters to get the time zone information. (optional)
     * @param  float|null $long pass the longitude of a location as query parameters to get the time zone information. (optional)
     * @param  string|null $ip You can pass any IPv4 or IPv6 address as a query parameter ip to get the regional timezone information. (optional)
     * @param  string|null $iata_code pass any 3 letter IATA code as a query paramter iata_code to get the comprehensive airport details along with the time zone information, in which that airport exists. (optional)
     * @param  string|null $icao_code pass any 4 letter ICAO code as a query paramter icao_code to get the comprehensive airport details along with the time zone information, in which that airport exists. (optional)
     * @param  string|null $lo_code pass any 5 letter UNLOCODE as a query paramter lo_code to get the comprehensive lo code/city details along with the time zone information of the concerned city. (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTimezoneInfo'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTimezoneInfoAsyncWithHttpInfo($tz = null, $location = null, $lat = null, $long = null, $ip = null, $iata_code = null, $icao_code = null, $lo_code = null, $output = null, $lang = null, string $contentType = self::contentTypes['getTimezoneInfo'][0])
    {
        $returnType = '\Ipgeolocation\Sdk\\Model\TimeZoneDetailedResponse';
        $request = $this->getTimezoneInfoRequest($tz, $location, $lat, $long, $ip, $iata_code, $icao_code, $lo_code, $output, $lang, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTimezoneInfo'
     *
     * @param  string|null $tz pass a valid time zone name as a query parameter tz to get the time zone information. (optional)
     * @param  string|null $location pass any address of a location as the query parameter location to get the time zone information. (optional)
     * @param  float|null $lat pass the latitude of a location as query parameters to get the time zone information. (optional)
     * @param  float|null $long pass the longitude of a location as query parameters to get the time zone information. (optional)
     * @param  string|null $ip You can pass any IPv4 or IPv6 address as a query parameter ip to get the regional timezone information. (optional)
     * @param  string|null $iata_code pass any 3 letter IATA code as a query paramter iata_code to get the comprehensive airport details along with the time zone information, in which that airport exists. (optional)
     * @param  string|null $icao_code pass any 4 letter ICAO code as a query paramter icao_code to get the comprehensive airport details along with the time zone information, in which that airport exists. (optional)
     * @param  string|null $lo_code pass any 5 letter UNLOCODE as a query paramter lo_code to get the comprehensive lo code/city details along with the time zone information of the concerned city. (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTimezoneInfo'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getTimezoneInfoRequest($tz = null, $location = null, $lat = null, $long = null, $ip = null, $iata_code = null, $icao_code = null, $lo_code = null, $output = null, $lang = null, string $contentType = self::contentTypes['getTimezoneInfo'][0])
    {












        $resourcePath = '/timezone';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $tz,
            'tz', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $location,
            'location', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $lat,
            'lat', // param base name
            'number', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $long,
            'long', // param base name
            'number', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $ip,
            'ip', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $iata_code,
            'iata_code', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $icao_code,
            'icao_code', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $lo_code,
            'lo_code', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $output,
            'output', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $lang,
            'lang', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);




        $headers = $this->headerSelector->selectHeaders(
            ['application/json', 'application/xml', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('apiKey');
        if ($apiKey !== null) {
            $queryParams['apiKey'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }

    private function handleResponseWithDataType(
        string $dataType,
        RequestInterface $request,
        ResponseInterface $response
    ): array {
        if ($dataType === '\SplFileObject') {
            $content = $response->getBody(); //stream goes to serializer
        } else {
            $content = (string) $response->getBody();
            if ($dataType !== 'string') {
                try {
                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                } catch (\JsonException $exception) {
                    throw new ApiException(
                        sprintf(
                            'Error JSON decoding server response (%s)',
                            $request->getUri()
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                        $content
                    );
                }
            }
        }

        return [
            ObjectSerializer::deserialize($content, $dataType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    private function responseWithinRangeCode(
        string $rangeCode,
        int $statusCode
    ): bool {
        $left = (int) ($rangeCode[0].'00');
        $right = (int) ($rangeCode[0].'99');

        return $statusCode >= $left && $statusCode <= $right;
    }
}
