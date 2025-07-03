<?php

/**
 * IPGeolocationAPITest
 * PHP version 8.1
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   ipgeoapi Generator team
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
 * IPGeolocationAPITest Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   ipgeoapi Generator team
 */
class IPGeolocationAPITest extends TestCase
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
     * Test case for getBulkIpGeolocation
     *
     * .
     *
     */
    public function testGetBulkIpGeolocation()
    {
        $config = \Ipgeolocation\Sdk\Configuration::getDefaultConfiguration()
            ->setApiKey('apiKey', 'API_KEY');

        $apiInstance = new \Ipgeolocation\Sdk\Api\IPGeolocationAPI(
            new \GuzzleHttp\Client(),
            $config
        );

        $bulkRequest = new \Ipgeolocation\Sdk\Model\BulkIPRequest([
            'ips' => ["8.8.8.8", "1.1.1.1"]
        ]);

        try {
            $response = $apiInstance->getBulkIpGeolocation(
                $bulkRequest,
                null,                  // lang
                null,                  // fields
                null,                  // excludes
                null,                  // include
                null                   // output
            );

            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            echo 'Exception when calling IPGeolocationAPI->getBulkIpGeolocation: ', $e->getMessage(), PHP_EOL;
        }
    }

    /**
     * Test case for getIpGeolocation
     *
     * .
     *
     */
    public function testGetIpGeolocation()
    {
        $config = \Ipgeolocation\Sdk\Configuration::getDefaultConfiguration()
            ->setApiKey('apiKey', 'API_KEY');

        $apiInstance = new \Ipgeolocation\Sdk\Api\IPGeolocationAPI(
            new \GuzzleHttp\Client(),
            $config
        );

        try {
            $response = $apiInstance->getIpGeolocation(
                null,        // IP
                null,        // lang
                null,        // fields
                null,        // excludes
                null,        // include
                null         // output
            );

            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            $this->fail("API call failed: " . $e->getMessage());
        }
    }
}
