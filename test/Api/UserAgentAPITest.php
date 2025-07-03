<?php

/**
 * UserAgentAPITest
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


namespace Ipgeolocation\Sdk\Test\Api;

use \Ipgeolocation\Sdk\Configuration;
use \Ipgeolocation\Sdk\ApiException;
use \Ipgeolocation\Sdk\ObjectSerializer;
use PHPUnit\Framework\TestCase;

/**
 * UserAgentAPITest Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 */
class UserAgentAPITest extends TestCase
{

    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass(): void {}

    /**
     * Setup before running each test case
     */
    public function setUp(): void {}

    /**
     * Clean up after running each test case
     */
    public function tearDown(): void {}

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass(): void {}

    /**
     * Test case for getUserAgentDetails
     *
     * Get details of user-agent.
     *
     */
    public function testGetUserAgentDetails()
    {
        $client = new \GuzzleHttp\Client();
        $config = \Ipgeolocation\Sdk\Configuration::getDefaultConfiguration()
            ->setApiKey('apiKey', 'API_KEY');

        $apiInstance = new \Ipgeolocation\Sdk\Api\UserAgentAPI($client, $config);

        try {
            $response = $apiInstance->getUserAgentDetails(
                null, // user_agent
                null  // output
            );
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            echo 'Exception when calling UserAgentAPI->getUserAgentDetails: ', $e->getMessage(), PHP_EOL;
        }
    }

    /**
     * Test case for parseBulkUserAgentStrings
     *
     * Handle multiple user-agent string lookups.
     *
     */
    public function testParseBulkUserAgentStrings()
    {
        $client = new \GuzzleHttp\Client();
        $config = \Ipgeolocation\Sdk\Configuration::getDefaultConfiguration()
            ->setApiKey('apiKey', 'API_KEY');

        $apiInstance = new \Ipgeolocation\Sdk\Api\UserAgentAPI($client, $config);

        $bulkRequest = new \Ipgeolocation\Sdk\Model\BulkUserAgentRequest([
            'ua_strings' => [
                "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36",
                "Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1"
            ]
        ]);

        try {
            $response = $apiInstance->parseBulkUserAgentStrings(
                null,           // output
                $bulkRequest    // request body with ua_strings array
            );
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            echo 'Exception when calling UserAgentAPI->parseBulkUserAgentStrings: ', $e->getMessage(), PHP_EOL;
        }
    }

    /**
     * Test case for parseUserAgentString
     *
     * Handle single User-Agent string.
     *
     */
    public function testParseUserAgentString()
    {
        // TODO: implement
        self::markTestIncomplete('Not implemented');
    }
}
