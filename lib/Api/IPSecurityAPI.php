<?php
/**
 * IPSecurityAPI
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
 * IPSecurityAPI Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 */
class IPSecurityAPI
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
        'getBulkIpSecurityInfo' => [
            'application/json',
        ],
        'getIpSecurityInfo' => [
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
     * Operation getBulkIpSecurityInfo
     *
     * @param  \Ipgeolocation\Sdk\\Model\BulkIPRequest $bulk_ip_request bulk_ip_request (required)
     * @param  string|null $include Include optional objects like &#x60;location&#x60;, &#x60;network&#x60;.  Use comma-separated values. Example: include&#x3D;location,network (optional)
     * @param  string|null $fields Get specific fields, objects from the response. (optional)
     * @param  string|null $excludes Exclude specific fields, objects from the response. (optional)
     * @param  string|null $output Desired output format. (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getBulkIpSecurityInfo'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Ipgeolocation\Sdk\\Model\BulkIPSecurityResponse[]|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse
     */
    public function getBulkIpSecurityInfo($bulk_ip_request, $include = null, $fields = null, $excludes = null, $output = null, $lang = null, string $contentType = self::contentTypes['getBulkIpSecurityInfo'][0])
    {
        list($response) = $this->getBulkIpSecurityInfoWithHttpInfo($bulk_ip_request, $include, $fields, $excludes, $output, $lang, $contentType);
        return $response;
    }

    /**
     * Operation getBulkIpSecurityInfoWithHttpInfo
     *
     * @param  \Ipgeolocation\Sdk\\Model\BulkIPRequest $bulk_ip_request (required)
     * @param  string|null $include Include optional objects like &#x60;location&#x60;, &#x60;network&#x60;.  Use comma-separated values. Example: include&#x3D;location,network (optional)
     * @param  string|null $fields Get specific fields, objects from the response. (optional)
     * @param  string|null $excludes Exclude specific fields, objects from the response. (optional)
     * @param  string|null $output Desired output format. (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getBulkIpSecurityInfo'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Ipgeolocation\Sdk\\Model\BulkIPSecurityResponse[]|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getBulkIpSecurityInfoWithHttpInfo($bulk_ip_request, $include = null, $fields = null, $excludes = null, $output = null, $lang = null, string $contentType = self::contentTypes['getBulkIpSecurityInfo'][0])
    {
        $request = $this->getBulkIpSecurityInfoRequest($bulk_ip_request, $include, $fields, $excludes, $output, $lang, $contentType);

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
                        '\Ipgeolocation\Sdk\\Model\BulkIPSecurityResponse[]',
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
                case 403:
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
                case 413:
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
                '\Ipgeolocation\Sdk\\Model\BulkIPSecurityResponse[]',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\BulkIPSecurityResponse[]',
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
                case 403:
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
                case 413:
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
     * Operation getBulkIpSecurityInfoAsync
     *
     * @param  \Ipgeolocation\Sdk\\Model\BulkIPRequest $bulk_ip_request (required)
     * @param  string|null $include Include optional objects like &#x60;location&#x60;, &#x60;network&#x60;.  Use comma-separated values. Example: include&#x3D;location,network (optional)
     * @param  string|null $fields Get specific fields, objects from the response. (optional)
     * @param  string|null $excludes Exclude specific fields, objects from the response. (optional)
     * @param  string|null $output Desired output format. (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getBulkIpSecurityInfo'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBulkIpSecurityInfoAsync($bulk_ip_request, $include = null, $fields = null, $excludes = null, $output = null, $lang = null, string $contentType = self::contentTypes['getBulkIpSecurityInfo'][0])
    {
        return $this->getBulkIpSecurityInfoAsyncWithHttpInfo($bulk_ip_request, $include, $fields, $excludes, $output, $lang, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getBulkIpSecurityInfoAsyncWithHttpInfo
     *
     * @param  \Ipgeolocation\Sdk\\Model\BulkIPRequest $bulk_ip_request (required)
     * @param  string|null $include Include optional objects like &#x60;location&#x60;, &#x60;network&#x60;.  Use comma-separated values. Example: include&#x3D;location,network (optional)
     * @param  string|null $fields Get specific fields, objects from the response. (optional)
     * @param  string|null $excludes Exclude specific fields, objects from the response. (optional)
     * @param  string|null $output Desired output format. (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getBulkIpSecurityInfo'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBulkIpSecurityInfoAsyncWithHttpInfo($bulk_ip_request, $include = null, $fields = null, $excludes = null, $output = null, $lang = null, string $contentType = self::contentTypes['getBulkIpSecurityInfo'][0])
    {
        $returnType = '\Ipgeolocation\Sdk\\Model\BulkIPSecurityResponse[]';
        $request = $this->getBulkIpSecurityInfoRequest($bulk_ip_request, $include, $fields, $excludes, $output, $lang, $contentType);

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
     * Create request for operation 'getBulkIpSecurityInfo'
     *
     * @param  \Ipgeolocation\Sdk\\Model\BulkIPRequest $bulk_ip_request (required)
     * @param  string|null $include Include optional objects like &#x60;location&#x60;, &#x60;network&#x60;.  Use comma-separated values. Example: include&#x3D;location,network (optional)
     * @param  string|null $fields Get specific fields, objects from the response. (optional)
     * @param  string|null $excludes Exclude specific fields, objects from the response. (optional)
     * @param  string|null $output Desired output format. (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getBulkIpSecurityInfo'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getBulkIpSecurityInfoRequest($bulk_ip_request, $include = null, $fields = null, $excludes = null, $output = null, $lang = null, string $contentType = self::contentTypes['getBulkIpSecurityInfo'][0])
    {

        // verify the required parameter 'bulk_ip_request' is set
        if ($bulk_ip_request === null || (is_array($bulk_ip_request) && count($bulk_ip_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $bulk_ip_request when calling getBulkIpSecurityInfo'
            );
        }







        $resourcePath = '/security-bulk';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $include,
            'include', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $fields,
            'fields', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $excludes,
            'excludes', // param base name
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
        if (isset($bulk_ip_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($bulk_ip_request));
            } else {
                $httpBody = $bulk_ip_request;
            }
        } elseif (count($formParams) > 0) {
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
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getIpSecurityInfo
     *
     * @param  string|null $ip query parameter &#39;ip&#39;. If not provided, will be your network IP (optional)
     * @param  string|null $include Include optional details like location and/or network. (optional)
     * @param  string|null $fields Get specific fields, objects from the response. (optional)
     * @param  string|null $excludes Exclude specific fields, objects from the response. (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getIpSecurityInfo'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Ipgeolocation\Sdk\\Model\IPSecurityAPIResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse
     */
    public function getIpSecurityInfo($ip = null, $include = null, $fields = null, $excludes = null, $output = null, $lang = null, string $contentType = self::contentTypes['getIpSecurityInfo'][0])
    {
        list($response) = $this->getIpSecurityInfoWithHttpInfo($ip, $include, $fields, $excludes, $output, $lang, $contentType);
        return $response;
    }

    /**
     * Operation getIpSecurityInfoWithHttpInfo
     *
     * @param  string|null $ip query parameter &#39;ip&#39;. If not provided, will be your network IP (optional)
     * @param  string|null $include Include optional details like location and/or network. (optional)
     * @param  string|null $fields Get specific fields, objects from the response. (optional)
     * @param  string|null $excludes Exclude specific fields, objects from the response. (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getIpSecurityInfo'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Ipgeolocation\Sdk\\Model\IPSecurityAPIResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getIpSecurityInfoWithHttpInfo($ip = null, $include = null, $fields = null, $excludes = null, $output = null, $lang = null, string $contentType = self::contentTypes['getIpSecurityInfo'][0])
    {
        $request = $this->getIpSecurityInfoRequest($ip, $include, $fields, $excludes, $output, $lang, $contentType);

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
                        '\Ipgeolocation\Sdk\\Model\IPSecurityAPIResponse',
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
                '\Ipgeolocation\Sdk\\Model\IPSecurityAPIResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\IPSecurityAPIResponse',
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
     * Operation getIpSecurityInfoAsync
     *
     * @param  string|null $ip query parameter &#39;ip&#39;. If not provided, will be your network IP (optional)
     * @param  string|null $include Include optional details like location and/or network. (optional)
     * @param  string|null $fields Get specific fields, objects from the response. (optional)
     * @param  string|null $excludes Exclude specific fields, objects from the response. (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getIpSecurityInfo'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getIpSecurityInfoAsync($ip = null, $include = null, $fields = null, $excludes = null, $output = null, $lang = null, string $contentType = self::contentTypes['getIpSecurityInfo'][0])
    {
        return $this->getIpSecurityInfoAsyncWithHttpInfo($ip, $include, $fields, $excludes, $output, $lang, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getIpSecurityInfoAsyncWithHttpInfo
     *
     * @param  string|null $ip query parameter &#39;ip&#39;. If not provided, will be your network IP (optional)
     * @param  string|null $include Include optional details like location and/or network. (optional)
     * @param  string|null $fields Get specific fields, objects from the response. (optional)
     * @param  string|null $excludes Exclude specific fields, objects from the response. (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getIpSecurityInfo'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getIpSecurityInfoAsyncWithHttpInfo($ip = null, $include = null, $fields = null, $excludes = null, $output = null, $lang = null, string $contentType = self::contentTypes['getIpSecurityInfo'][0])
    {
        $returnType = '\Ipgeolocation\Sdk\\Model\IPSecurityAPIResponse';
        $request = $this->getIpSecurityInfoRequest($ip, $include, $fields, $excludes, $output, $lang, $contentType);

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
     * Create request for operation 'getIpSecurityInfo'
     *
     * @param  string|null $ip query parameter &#39;ip&#39;. If not provided, will be your network IP (optional)
     * @param  string|null $include Include optional details like location and/or network. (optional)
     * @param  string|null $fields Get specific fields, objects from the response. (optional)
     * @param  string|null $excludes Exclude specific fields, objects from the response. (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string|null $lang By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getIpSecurityInfo'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getIpSecurityInfoRequest($ip = null, $include = null, $fields = null, $excludes = null, $output = null, $lang = null, string $contentType = self::contentTypes['getIpSecurityInfo'][0])
    {








        $resourcePath = '/security';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

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
            $include,
            'include', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $fields,
            'fields', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $excludes,
            'excludes', // param base name
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
