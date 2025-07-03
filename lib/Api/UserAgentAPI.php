<?php
/**
 * UserAgentAPI
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
 * UserAgentAPI Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 */
class UserAgentAPI
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
        'getUserAgentDetails' => [
            'application/json',
        ],
        'parseBulkUserAgentStrings' => [
            'application/json',
        ],
        'parseUserAgentString' => [
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
     * Operation getUserAgentDetails
     *
     * Get details of user-agent
     *
     * @param  string|null $user_agent user_agent (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserAgentDetails'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Ipgeolocation\Sdk\\Model\UserAgentData|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse
     */
    public function getUserAgentDetails($user_agent = null, $output = null, string $contentType = self::contentTypes['getUserAgentDetails'][0])
    {
        list($response) = $this->getUserAgentDetailsWithHttpInfo($user_agent, $output, $contentType);
        return $response;
    }

    /**
     * Operation getUserAgentDetailsWithHttpInfo
     *
     * Get details of user-agent
     *
     * @param  string|null $user_agent (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserAgentDetails'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Ipgeolocation\Sdk\\Model\UserAgentData|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getUserAgentDetailsWithHttpInfo($user_agent = null, $output = null, string $contentType = self::contentTypes['getUserAgentDetails'][0])
    {
        $request = $this->getUserAgentDetailsRequest($user_agent, $output, $contentType);

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
                        '\Ipgeolocation\Sdk\\Model\UserAgentData',
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
                '\Ipgeolocation\Sdk\\Model\UserAgentData',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\UserAgentData',
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
     * Operation getUserAgentDetailsAsync
     *
     * Get details of user-agent
     *
     * @param  string|null $user_agent (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserAgentDetails'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getUserAgentDetailsAsync($user_agent = null, $output = null, string $contentType = self::contentTypes['getUserAgentDetails'][0])
    {
        return $this->getUserAgentDetailsAsyncWithHttpInfo($user_agent, $output, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getUserAgentDetailsAsyncWithHttpInfo
     *
     * Get details of user-agent
     *
     * @param  string|null $user_agent (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserAgentDetails'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getUserAgentDetailsAsyncWithHttpInfo($user_agent = null, $output = null, string $contentType = self::contentTypes['getUserAgentDetails'][0])
    {
        $returnType = '\Ipgeolocation\Sdk\\Model\UserAgentData';
        $request = $this->getUserAgentDetailsRequest($user_agent, $output, $contentType);

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
     * Create request for operation 'getUserAgentDetails'
     *
     * @param  string|null $user_agent (optional)
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserAgentDetails'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getUserAgentDetailsRequest($user_agent = null, $output = null, string $contentType = self::contentTypes['getUserAgentDetails'][0])
    {




        $resourcePath = '/user-agent';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $output,
            'output', // param base name
            'string', // ipgeoapiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);

        // header params
        if ($user_agent !== null) {
            $headerParams['User-Agent'] = ObjectSerializer::toHeaderValue($user_agent);
        }



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
     * Operation parseBulkUserAgentStrings
     *
     * Handle multiple user-agent string lookups
     *
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  \Ipgeolocation\Sdk\\Model\BulkUserAgentRequest|null $parse_bulk_user_agent_strings_request parse_bulk_user_agent_strings_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['parseBulkUserAgentStrings'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Ipgeolocation\Sdk\\Model\UserAgentData[]|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse
     */
    public function parseBulkUserAgentStrings($output = null, $parse_bulk_user_agent_strings_request = null, string $contentType = self::contentTypes['parseBulkUserAgentStrings'][0])
    {
        list($response) = $this->parseBulkUserAgentStringsWithHttpInfo($output, $parse_bulk_user_agent_strings_request, $contentType);
        return $response;
    }

    /**
     * Operation parseBulkUserAgentStringsWithHttpInfo
     *
     * Handle multiple user-agent string lookups
     *
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  \Ipgeolocation\Sdk\\Model\BulkUserAgentRequest|null $parse_bulk_user_agent_strings_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['parseBulkUserAgentStrings'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Ipgeolocation\Sdk\\Model\UserAgentData[]|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function parseBulkUserAgentStringsWithHttpInfo($output = null, $parse_bulk_user_agent_strings_request = null, string $contentType = self::contentTypes['parseBulkUserAgentStrings'][0])
    {
        $request = $this->BulkUserAgentRequest($output, $parse_bulk_user_agent_strings_request, $contentType);

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
                        '\Ipgeolocation\Sdk\\Model\UserAgentData[]',
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
                '\Ipgeolocation\Sdk\\Model\UserAgentData[]',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\UserAgentData[]',
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
     * Operation parseBulkUserAgentStringsAsync
     *
     * Handle multiple user-agent string lookups
     *
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  \Ipgeolocation\Sdk\\Model\BulkUserAgentRequest|null $parse_bulk_user_agent_strings_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['parseBulkUserAgentStrings'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseBulkUserAgentStringsAsync($output = null, $parse_bulk_user_agent_strings_request = null, string $contentType = self::contentTypes['parseBulkUserAgentStrings'][0])
    {
        return $this->parseBulkUserAgentStringsAsyncWithHttpInfo($output, $parse_bulk_user_agent_strings_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation parseBulkUserAgentStringsAsyncWithHttpInfo
     *
     * Handle multiple user-agent string lookups
     *
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  \Ipgeolocation\Sdk\\Model\BulkUserAgentRequest|null $parse_bulk_user_agent_strings_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['parseBulkUserAgentStrings'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseBulkUserAgentStringsAsyncWithHttpInfo($output = null, $parse_bulk_user_agent_strings_request = null, string $contentType = self::contentTypes['parseBulkUserAgentStrings'][0])
    {
        $returnType = '\Ipgeolocation\Sdk\\Model\UserAgentData[]';
        $request = $this->BulkUserAgentRequest($output, $parse_bulk_user_agent_strings_request, $contentType);

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
     * Create request for operation 'parseBulkUserAgentStrings'
     *
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  \Ipgeolocation\Sdk\\Model\BulkUserAgentRequest|null $parse_bulk_user_agent_strings_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['parseBulkUserAgentStrings'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function BulkUserAgentRequest($output = null, $parse_bulk_user_agent_strings_request = null, string $contentType = self::contentTypes['parseBulkUserAgentStrings'][0])
    {




        $resourcePath = '/user-agent-bulk';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $output,
            'output', // param base name
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
        if (isset($parse_bulk_user_agent_strings_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($parse_bulk_user_agent_strings_request));
            } else {
                $httpBody = $parse_bulk_user_agent_strings_request;
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
     * Operation parseUserAgentString
     *
     * Handle single User-Agent string
     *
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  \Ipgeolocation\Sdk\\Model\UserAgentRequest|null $parse_user_agent_string_request parse_user_agent_string_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['parseUserAgentString'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Ipgeolocation\Sdk\\Model\UserAgentData|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse
     */
    public function parseUserAgentString($output = null, $parse_user_agent_string_request = null, string $contentType = self::contentTypes['parseUserAgentString'][0])
    {
        list($response) = $this->parseUserAgentStringWithHttpInfo($output, $parse_user_agent_string_request, $contentType);
        return $response;
    }

    /**
     * Operation parseUserAgentStringWithHttpInfo
     *
     * Handle single User-Agent string
     *
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  \Ipgeolocation\Sdk\\Model\UserAgentRequest|null $parse_user_agent_string_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['parseUserAgentString'] to see the possible values for this operation
     *
     * @throws \Ipgeolocation\Sdk\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Ipgeolocation\Sdk\\Model\UserAgentData|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse|\Ipgeolocation\Sdk\\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function parseUserAgentStringWithHttpInfo($output = null, $parse_user_agent_string_request = null, string $contentType = self::contentTypes['parseUserAgentString'][0])
    {
        $request = $this->UserAgentRequest($output, $parse_user_agent_string_request, $contentType);

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
                        '\Ipgeolocation\Sdk\\Model\UserAgentData',
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
                '\Ipgeolocation\Sdk\\Model\UserAgentData',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Ipgeolocation\Sdk\\Model\UserAgentData',
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
     * Operation parseUserAgentStringAsync
     *
     * Handle single User-Agent string
     *
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  \Ipgeolocation\Sdk\\Model\UserAgentRequest|null $parse_user_agent_string_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['parseUserAgentString'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseUserAgentStringAsync($output = null, $parse_user_agent_string_request = null, string $contentType = self::contentTypes['parseUserAgentString'][0])
    {
        return $this->parseUserAgentStringAsyncWithHttpInfo($output, $parse_user_agent_string_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation parseUserAgentStringAsyncWithHttpInfo
     *
     * Handle single User-Agent string
     *
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  \Ipgeolocation\Sdk\\Model\UserAgentRequest|null $parse_user_agent_string_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['parseUserAgentString'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function parseUserAgentStringAsyncWithHttpInfo($output = null, $parse_user_agent_string_request = null, string $contentType = self::contentTypes['parseUserAgentString'][0])
    {
        $returnType = '\Ipgeolocation\Sdk\\Model\UserAgentData';
        $request = $this->UserAgentRequest($output, $parse_user_agent_string_request, $contentType);

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
     * Create request for operation 'parseUserAgentString'
     *
     * @param  string|null $output Desired output format (json or xml). (optional)
     * @param  \Ipgeolocation\Sdk\\Model\UserAgentRequest|null $parse_user_agent_string_request (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['parseUserAgentString'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function UserAgentRequest($output = null, $parse_user_agent_string_request = null, string $contentType = self::contentTypes['parseUserAgentString'][0])
    {




        $resourcePath = '/user-agent';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $output,
            'output', // param base name
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
        if (isset($parse_user_agent_string_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($parse_user_agent_string_request));
            } else {
                $httpBody = $parse_user_agent_string_request;
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
