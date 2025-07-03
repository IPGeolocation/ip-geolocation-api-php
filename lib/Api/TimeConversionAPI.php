<?php
/**
 * TimeConversionAPI
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
 * TimeConversionAPI Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 */
class TimeConversionAPI
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
        'convertTimeBetweenTimezones' => [
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
     * Operation convertTimeBetweenTimezones
     *
     * @param  string|null $time time parameter takes the input in the following two formats: i) &#39;yyyy-MM-dd HH:mm&#39;, and ii) &#39;yyyy-MM-dd HH:mm:ss&#39;. This parameter is optional and you can omit it to convert the current time between two coordinates, time zones or locations. (optional)
     * @param  string|null $tz_from timezone to convert from (optional)
     * @param  string|null $tz_to timezone to convert to (optional)
     * @param  float|null $lat_from latitude to convert from (optional)
     * @param  float|null $long_from longitude to convert from (optional)
     * @param  float|null $lat_to latitude to convert to (optional)
     * @param  float|null $long_to longitude to convert to (optional)
     * @param  string|null $location_from location to convert from (optional)
     * @param  string|null $location_to location to convert to (optional)
     * @param  string|null $icao_from location to convert from (optional)
     * @param  string|null $icao_to location to convert to (optional)
     * @param  string|null $iata_from location to convert from (optional)
     * @param  string|null $iata_to location to convert to (optional)
     * @param  string|null $locode_from location to convert from (optional)
     * @param  string|null $locode_to location to convert to (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['convertTimeBetweenTimezones'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Ipgeolocation\Sdk\\Model\TimeConversionResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse
     */
    public function convertTimeBetweenTimezones($time = null, $tz_from = null, $tz_to = null, $lat_from = null, $long_from = null, $lat_to = null, $long_to = null, $location_from = null, $location_to = null, $icao_from = null, $icao_to = null, $iata_from = null, $iata_to = null, $locode_from = null, $locode_to = null, string $contentType = self::contentTypes['convertTimeBetweenTimezones'][0])
    {
        list($response) = $this->convertTimeBetweenTimezonesWithHttpInfo($time, $tz_from, $tz_to, $lat_from, $long_from, $lat_to, $long_to, $location_from, $location_to, $icao_from, $icao_to, $iata_from, $iata_to, $locode_from, $locode_to, $contentType);
        return $response;
    }

    /**
     * Operation convertTimeBetweenTimezonesWithHttpInfo
     *
     * @param  string|null $time time parameter takes the input in the following two formats: i) &#39;yyyy-MM-dd HH:mm&#39;, and ii) &#39;yyyy-MM-dd HH:mm:ss&#39;. This parameter is optional and you can omit it to convert the current time between two coordinates, time zones or locations. (optional)
     * @param  string|null $tz_from timezone to convert from (optional)
     * @param  string|null $tz_to timezone to convert to (optional)
     * @param  float|null $lat_from latitude to convert from (optional)
     * @param  float|null $long_from longitude to convert from (optional)
     * @param  float|null $lat_to latitude to convert to (optional)
     * @param  float|null $long_to longitude to convert to (optional)
     * @param  string|null $location_from location to convert from (optional)
     * @param  string|null $location_to location to convert to (optional)
     * @param  string|null $icao_from location to convert from (optional)
     * @param  string|null $icao_to location to convert to (optional)
     * @param  string|null $iata_from location to convert from (optional)
     * @param  string|null $iata_to location to convert to (optional)
     * @param  string|null $locode_from location to convert from (optional)
     * @param  string|null $locode_to location to convert to (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['convertTimeBetweenTimezones'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Ipgeolocation\Sdk\\Model\TimeConversionResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function convertTimeBetweenTimezonesWithHttpInfo($time = null, $tz_from = null, $tz_to = null, $lat_from = null, $long_from = null, $lat_to = null, $long_to = null, $location_from = null, $location_to = null, $icao_from = null, $icao_to = null, $iata_from = null, $iata_to = null, $locode_from = null, $locode_to = null, string $contentType = self::contentTypes['convertTimeBetweenTimezones'][0])
    {
        $request = $this->convertTimeBetweenTimezonesRequest($time, $tz_from, $tz_to, $lat_from, $long_from, $lat_to, $long_to, $location_from, $location_to, $icao_from, $icao_to, $iata_from, $iata_to, $locode_from, $locode_to, $contentType);

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
                        '\Ipgeolocation\Sdk\\Model\TimeConversionResponse',
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
                '\Ipgeolocation\Sdk\\Model\TimeConversionResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\TimeConversionResponse',
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
     * Operation convertTimeBetweenTimezonesAsync
     *
     * @param  string|null $time time parameter takes the input in the following two formats: i) &#39;yyyy-MM-dd HH:mm&#39;, and ii) &#39;yyyy-MM-dd HH:mm:ss&#39;. This parameter is optional and you can omit it to convert the current time between two coordinates, time zones or locations. (optional)
     * @param  string|null $tz_from timezone to convert from (optional)
     * @param  string|null $tz_to timezone to convert to (optional)
     * @param  float|null $lat_from latitude to convert from (optional)
     * @param  float|null $long_from longitude to convert from (optional)
     * @param  float|null $lat_to latitude to convert to (optional)
     * @param  float|null $long_to longitude to convert to (optional)
     * @param  string|null $location_from location to convert from (optional)
     * @param  string|null $location_to location to convert to (optional)
     * @param  string|null $icao_from location to convert from (optional)
     * @param  string|null $icao_to location to convert to (optional)
     * @param  string|null $iata_from location to convert from (optional)
     * @param  string|null $iata_to location to convert to (optional)
     * @param  string|null $locode_from location to convert from (optional)
     * @param  string|null $locode_to location to convert to (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['convertTimeBetweenTimezones'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function convertTimeBetweenTimezonesAsync($time = null, $tz_from = null, $tz_to = null, $lat_from = null, $long_from = null, $lat_to = null, $long_to = null, $location_from = null, $location_to = null, $icao_from = null, $icao_to = null, $iata_from = null, $iata_to = null, $locode_from = null, $locode_to = null, string $contentType = self::contentTypes['convertTimeBetweenTimezones'][0])
    {
        return $this->convertTimeBetweenTimezonesAsyncWithHttpInfo($time, $tz_from, $tz_to, $lat_from, $long_from, $lat_to, $long_to, $location_from, $location_to, $icao_from, $icao_to, $iata_from, $iata_to, $locode_from, $locode_to, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation convertTimeBetweenTimezonesAsyncWithHttpInfo
     *
     * @param  string|null $time time parameter takes the input in the following two formats: i) &#39;yyyy-MM-dd HH:mm&#39;, and ii) &#39;yyyy-MM-dd HH:mm:ss&#39;. This parameter is optional and you can omit it to convert the current time between two coordinates, time zones or locations. (optional)
     * @param  string|null $tz_from timezone to convert from (optional)
     * @param  string|null $tz_to timezone to convert to (optional)
     * @param  float|null $lat_from latitude to convert from (optional)
     * @param  float|null $long_from longitude to convert from (optional)
     * @param  float|null $lat_to latitude to convert to (optional)
     * @param  float|null $long_to longitude to convert to (optional)
     * @param  string|null $location_from location to convert from (optional)
     * @param  string|null $location_to location to convert to (optional)
     * @param  string|null $icao_from location to convert from (optional)
     * @param  string|null $icao_to location to convert to (optional)
     * @param  string|null $iata_from location to convert from (optional)
     * @param  string|null $iata_to location to convert to (optional)
     * @param  string|null $locode_from location to convert from (optional)
     * @param  string|null $locode_to location to convert to (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['convertTimeBetweenTimezones'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function convertTimeBetweenTimezonesAsyncWithHttpInfo($time = null, $tz_from = null, $tz_to = null, $lat_from = null, $long_from = null, $lat_to = null, $long_to = null, $location_from = null, $location_to = null, $icao_from = null, $icao_to = null, $iata_from = null, $iata_to = null, $locode_from = null, $locode_to = null, string $contentType = self::contentTypes['convertTimeBetweenTimezones'][0])
    {
        $returnType = '\Ipgeolocation\Sdk\\Model\TimeConversionResponse';
        $request = $this->convertTimeBetweenTimezonesRequest($time, $tz_from, $tz_to, $lat_from, $long_from, $lat_to, $long_to, $location_from, $location_to, $icao_from, $icao_to, $iata_from, $iata_to, $locode_from, $locode_to, $contentType);

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
     * Create request for operation 'convertTimeBetweenTimezones'
     *
     * @param  string|null $time time parameter takes the input in the following two formats: i) &#39;yyyy-MM-dd HH:mm&#39;, and ii) &#39;yyyy-MM-dd HH:mm:ss&#39;. This parameter is optional and you can omit it to convert the current time between two coordinates, time zones or locations. (optional)
     * @param  string|null $tz_from timezone to convert from (optional)
     * @param  string|null $tz_to timezone to convert to (optional)
     * @param  float|null $lat_from latitude to convert from (optional)
     * @param  float|null $long_from longitude to convert from (optional)
     * @param  float|null $lat_to latitude to convert to (optional)
     * @param  float|null $long_to longitude to convert to (optional)
     * @param  string|null $location_from location to convert from (optional)
     * @param  string|null $location_to location to convert to (optional)
     * @param  string|null $icao_from location to convert from (optional)
     * @param  string|null $icao_to location to convert to (optional)
     * @param  string|null $iata_from location to convert from (optional)
     * @param  string|null $iata_to location to convert to (optional)
     * @param  string|null $locode_from location to convert from (optional)
     * @param  string|null $locode_to location to convert to (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['convertTimeBetweenTimezones'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function convertTimeBetweenTimezonesRequest($time = null, $tz_from = null, $tz_to = null, $lat_from = null, $long_from = null, $lat_to = null, $long_to = null, $location_from = null, $location_to = null, $icao_from = null, $icao_to = null, $iata_from = null, $iata_to = null, $locode_from = null, $locode_to = null, string $contentType = self::contentTypes['convertTimeBetweenTimezones'][0])
    {

















        $resourcePath = '/timezone/convert';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $time,
            'time', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $tz_from,
            'tz_from', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $tz_to,
            'tz_to', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $lat_from,
            'lat_from', // param base name
            'number', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $long_from,
            'long_from', // param base name
            'number', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $lat_to,
            'lat_to', // param base name
            'number', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $long_to,
            'long_to', // param base name
            'number', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $location_from,
            'location_from', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $location_to,
            'location_to', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $icao_from,
            'icao_from', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $icao_to,
            'icao_to', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $iata_from,
            'iata_from', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $iata_to,
            'iata_to', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $locode_from,
            'locode_from', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $locode_to,
            'locode_to', // param base name
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
