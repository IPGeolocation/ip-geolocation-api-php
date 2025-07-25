<?php

/**
 * AbuseContactAPITest
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
 * AbuseContactAPITest Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 */
class AbuseContactAPITest extends TestCase
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
     * Test case for getAbuseContactInfo
     *
     * .
     *
     */
    public function testGetAbuseContactInfo()
    {
        $client = new \GuzzleHttp\Client();
        $config = \Ipgeolocation\Sdk\Configuration::getDefaultConfiguration()
            ->setApiKey('apiKey', 'API_KEY');

        $apiInstance = new \Ipgeolocation\Sdk\Api\AbuseContactAPI($client, $config);

        try {
            $response = $apiInstance->getAbuseContactInfo(
                null,           // ip
                null,           // excludes
                null            // fields
            );
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            echo 'Exception when calling AbuseContactAPI->getAbuseContactInfo: ', $e->getMessage(), PHP_EOL;
        }
    }
}
