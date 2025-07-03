<?php

/**
 * IPSecurityAPITest
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
 * IPSecurityAPITest Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 */
class IPSecurityAPITest extends TestCase
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
     * Test case for getBulkIpSecurityInfo
     *
     * .
     *
     */
    public function testGetBulkIpSecurityInfo()
    {
        $config = \Ipgeolocation\Sdk\Configuration::getDefaultConfiguration()
            ->setApiKey('apiKey', 'API_KEY');

        $apiInstance = new \Ipgeolocation\Sdk\Api\IPSecurityAPI(
            new \GuzzleHttp\Client(),
            $config
        );

        $bulkRequest = new \Ipgeolocation\Sdk\Model\BulkIPRequest([
            'ips' => ["2.56.188.34", "2.56.188.35"]
        ]);

        try {
            $response = $apiInstance->getBulkIpSecurityInfo(
                $bulkRequest,   // bulk request object
                null,           // include
                null,           // fields
                null,           // excludes
                null,           // output
                null            // lang
            );

            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            echo "API call failed: {$e->getMessage()}";
        }
    }

    /**
     * Test case for getIpSecurityInfo
     *
     * .
     *
     */
    public function testGetIpSecurityInfo()
    {
        $config = \Ipgeolocation\Sdk\Configuration::getDefaultConfiguration()
            ->setApiKey('apiKey', 'API_KEY');

        $apiInstance = new \Ipgeolocation\Sdk\Api\IPSecurityAPI(
            new \GuzzleHttp\Client(),
            $config
        );

        try {
            $response = $apiInstance->getIpSecurityInfo(
                null,              // ip
                null,              // include
                null,              // fields
                null,              // excludes
                null,              // output
                null               // lang
            );
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            echo "API call failed: {$e->getMessage()}";
        }
    }
}
