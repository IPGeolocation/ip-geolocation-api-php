<?php

/**
 * TimeConversionAPITest
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
 * TimeConversionAPITest Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 */
class TimeConversionAPITest extends TestCase
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
     * Test case for convertTimeBetweenTimezones
     *
     * .
     *
     */
    public function testConvertTimeBetweenTimezones()
    {
        $client = new \GuzzleHttp\Client();
        $config = \Ipgeolocation\Sdk\Configuration::getDefaultConfiguration()
            ->setApiKey('apiKey', 'API_KEY');

        $apiInstance = new \Ipgeolocation\Sdk\Api\TimeConversionAPI($client, $config);

        try {
            $response = $apiInstance->convertTimeBetweenTimezones(
                null,               // time
                null,               // tz_from    
                null,               // tz_to
                null,               // lat_from
                null,               // long_from
                null,               // lat_to
                null,               // long_to,
                null,               // location_from
                null,               // location_to
                null,               // icao_from
                null,               // icao_to
                null,               // iata_from
                null,               // iata_to
                null,               // locode_from
                null                // locode_to
            );
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            echo 'Exception when calling TimezoneAPI->convertTimezone: ', $e->getMessage(), PHP_EOL;
        }
    }
}
