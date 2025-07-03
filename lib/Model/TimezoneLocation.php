<?php
/**
 * TimezoneLocation
 *
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



namespace Ipgeolocation\Sdk\Model;

use \ArrayAccess;
use \Ipgeolocation\Sdk\ObjectSerializer;

/**
 * TimezoneLocation Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 * @implements \ArrayAccess<string, mixed>
 */
class TimezoneLocation implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $ipgeoapiModelName = 'TimezoneLocation';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $ipgeoapiTypes = [
        'location_string' => 'string',
        'continent_code' => 'string',
        'continent_name' => 'string',
        'country_code2' => 'string',
        'country_code3' => 'string',
        'country_name' => 'string',
        'country_name_official' => 'string',
        'is_eu' => 'bool',
        'state_prov' => 'string',
        'state_code' => 'string',
        'district' => 'string',
        'city' => 'string',
        'locality' => 'string',
        'zipcode' => 'string',
        'latitude' => 'string',
        'longitude' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $ipgeoapiFormats = [
        'location_string' => null,
        'continent_code' => null,
        'continent_name' => null,
        'country_code2' => null,
        'country_code3' => null,
        'country_name' => null,
        'country_name_official' => null,
        'is_eu' => null,
        'state_prov' => null,
        'state_code' => null,
        'district' => null,
        'city' => null,
        'locality' => null,
        'zipcode' => null,
        'latitude' => null,
        'longitude' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $ipgeoapiNullables = [
        'location_string' => false,
        'continent_code' => false,
        'continent_name' => false,
        'country_code2' => false,
        'country_code3' => false,
        'country_name' => false,
        'country_name_official' => false,
        'is_eu' => false,
        'state_prov' => false,
        'state_code' => false,
        'district' => false,
        'city' => false,
        'locality' => false,
        'zipcode' => false,
        'latitude' => false,
        'longitude' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $ipgeoapiNullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function ipgeoapiTypes()
    {
        return self::$ipgeoapiTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function ipgeoapiFormats()
    {
        return self::$ipgeoapiFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function ipgeoapiNullables(): array
    {
        return self::$ipgeoapiNullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getipgeoapiNullablesSetToNull(): array
    {
        return $this->ipgeoapiNullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $ipgeoapiNullablesSetToNull
     */
    private function setipgeoapiNullablesSetToNull(array $ipgeoapiNullablesSetToNull): void
    {
        $this->ipgeoapiNullablesSetToNull = $ipgeoapiNullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::ipgeoapiNullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getipgeoapiNullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'location_string' => 'location_string',
        'continent_code' => 'continent_code',
        'continent_name' => 'continent_name',
        'country_code2' => 'country_code2',
        'country_code3' => 'country_code3',
        'country_name' => 'country_name',
        'country_name_official' => 'country_name_official',
        'is_eu' => 'is_eu',
        'state_prov' => 'state_prov',
        'state_code' => 'state_code',
        'district' => 'district',
        'city' => 'city',
        'locality' => 'locality',
        'zipcode' => 'zipcode',
        'latitude' => 'latitude',
        'longitude' => 'longitude'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'location_string' => 'setLocationString',
        'continent_code' => 'setContinentCode',
        'continent_name' => 'setContinentName',
        'country_code2' => 'setCountryCode2',
        'country_code3' => 'setCountryCode3',
        'country_name' => 'setCountryName',
        'country_name_official' => 'setCountryNameOfficial',
        'is_eu' => 'setIsEu',
        'state_prov' => 'setStateProv',
        'state_code' => 'setStateCode',
        'district' => 'setDistrict',
        'city' => 'setCity',
        'locality' => 'setLocality',
        'zipcode' => 'setZipcode',
        'latitude' => 'setLatitude',
        'longitude' => 'setLongitude'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'location_string' => 'getLocationString',
        'continent_code' => 'getContinentCode',
        'continent_name' => 'getContinentName',
        'country_code2' => 'getCountryCode2',
        'country_code3' => 'getCountryCode3',
        'country_name' => 'getCountryName',
        'country_name_official' => 'getCountryNameOfficial',
        'is_eu' => 'getIsEu',
        'state_prov' => 'getStateProv',
        'state_code' => 'getStateCode',
        'district' => 'getDistrict',
        'city' => 'getCity',
        'locality' => 'getLocality',
        'zipcode' => 'getZipcode',
        'latitude' => 'getLatitude',
        'longitude' => 'getLongitude'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$ipgeoapiModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[]|null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('location_string', $data ?? [], null);
        $this->setIfExists('continent_code', $data ?? [], null);
        $this->setIfExists('continent_name', $data ?? [], null);
        $this->setIfExists('country_code2', $data ?? [], null);
        $this->setIfExists('country_code3', $data ?? [], null);
        $this->setIfExists('country_name', $data ?? [], null);
        $this->setIfExists('country_name_official', $data ?? [], null);
        $this->setIfExists('is_eu', $data ?? [], null);
        $this->setIfExists('state_prov', $data ?? [], null);
        $this->setIfExists('state_code', $data ?? [], null);
        $this->setIfExists('district', $data ?? [], null);
        $this->setIfExists('city', $data ?? [], null);
        $this->setIfExists('locality', $data ?? [], null);
        $this->setIfExists('zipcode', $data ?? [], null);
        $this->setIfExists('latitude', $data ?? [], null);
        $this->setIfExists('longitude', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->ipgeoapiNullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->ipgeoapiNullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets location_string
     *
     * @return string|null
     */
    public function getLocationString()
    {
        return $this->container['location_string'];
    }

    /**
     * Sets location_string
     *
     * @param string|null $location_string location_string
     *
     * @return self
     */
    public function setLocationString($location_string)
    {
        if (is_null($location_string)) {
            throw new \InvalidArgumentException('non-nullable location_string cannot be null');
        }
        $this->container['location_string'] = $location_string;

        return $this;
    }

    /**
     * Gets continent_code
     *
     * @return string|null
     */
    public function getContinentCode()
    {
        return $this->container['continent_code'];
    }

    /**
     * Sets continent_code
     *
     * @param string|null $continent_code continent_code
     *
     * @return self
     */
    public function setContinentCode($continent_code)
    {
        if (is_null($continent_code)) {
            throw new \InvalidArgumentException('non-nullable continent_code cannot be null');
        }
        $this->container['continent_code'] = $continent_code;

        return $this;
    }

    /**
     * Gets continent_name
     *
     * @return string|null
     */
    public function getContinentName()
    {
        return $this->container['continent_name'];
    }

    /**
     * Sets continent_name
     *
     * @param string|null $continent_name continent_name
     *
     * @return self
     */
    public function setContinentName($continent_name)
    {
        if (is_null($continent_name)) {
            throw new \InvalidArgumentException('non-nullable continent_name cannot be null');
        }
        $this->container['continent_name'] = $continent_name;

        return $this;
    }

    /**
     * Gets country_code2
     *
     * @return string|null
     */
    public function getCountryCode2()
    {
        return $this->container['country_code2'];
    }

    /**
     * Sets country_code2
     *
     * @param string|null $country_code2 country_code2
     *
     * @return self
     */
    public function setCountryCode2($country_code2)
    {
        if (is_null($country_code2)) {
            throw new \InvalidArgumentException('non-nullable country_code2 cannot be null');
        }
        $this->container['country_code2'] = $country_code2;

        return $this;
    }

    /**
     * Gets country_code3
     *
     * @return string|null
     */
    public function getCountryCode3()
    {
        return $this->container['country_code3'];
    }

    /**
     * Sets country_code3
     *
     * @param string|null $country_code3 country_code3
     *
     * @return self
     */
    public function setCountryCode3($country_code3)
    {
        if (is_null($country_code3)) {
            throw new \InvalidArgumentException('non-nullable country_code3 cannot be null');
        }
        $this->container['country_code3'] = $country_code3;

        return $this;
    }

    /**
     * Gets country_name
     *
     * @return string|null
     */
    public function getCountryName()
    {
        return $this->container['country_name'];
    }

    /**
     * Sets country_name
     *
     * @param string|null $country_name country_name
     *
     * @return self
     */
    public function setCountryName($country_name)
    {
        if (is_null($country_name)) {
            throw new \InvalidArgumentException('non-nullable country_name cannot be null');
        }
        $this->container['country_name'] = $country_name;

        return $this;
    }

    /**
     * Gets country_name_official
     *
     * @return string|null
     */
    public function getCountryNameOfficial()
    {
        return $this->container['country_name_official'];
    }

    /**
     * Sets country_name_official
     *
     * @param string|null $country_name_official country_name_official
     *
     * @return self
     */
    public function setCountryNameOfficial($country_name_official)
    {
        if (is_null($country_name_official)) {
            throw new \InvalidArgumentException('non-nullable country_name_official cannot be null');
        }
        $this->container['country_name_official'] = $country_name_official;

        return $this;
    }

    /**
     * Gets is_eu
     *
     * @return bool|null
     */
    public function getIsEu()
    {
        return $this->container['is_eu'];
    }

    /**
     * Sets is_eu
     *
     * @param bool|null $is_eu is_eu
     *
     * @return self
     */
    public function setIsEu($is_eu)
    {
        if (is_null($is_eu)) {
            throw new \InvalidArgumentException('non-nullable is_eu cannot be null');
        }
        $this->container['is_eu'] = $is_eu;

        return $this;
    }

    /**
     * Gets state_prov
     *
     * @return string|null
     */
    public function getStateProv()
    {
        return $this->container['state_prov'];
    }

    /**
     * Sets state_prov
     *
     * @param string|null $state_prov state_prov
     *
     * @return self
     */
    public function setStateProv($state_prov)
    {
        if (is_null($state_prov)) {
            throw new \InvalidArgumentException('non-nullable state_prov cannot be null');
        }
        $this->container['state_prov'] = $state_prov;

        return $this;
    }

    /**
     * Gets state_code
     *
     * @return string|null
     */
    public function getStateCode()
    {
        return $this->container['state_code'];
    }

    /**
     * Sets state_code
     *
     * @param string|null $state_code state_code
     *
     * @return self
     */
    public function setStateCode($state_code)
    {
        if (is_null($state_code)) {
            throw new \InvalidArgumentException('non-nullable state_code cannot be null');
        }
        $this->container['state_code'] = $state_code;

        return $this;
    }

    /**
     * Gets district
     *
     * @return string|null
     */
    public function getDistrict()
    {
        return $this->container['district'];
    }

    /**
     * Sets district
     *
     * @param string|null $district district
     *
     * @return self
     */
    public function setDistrict($district)
    {
        if (is_null($district)) {
            throw new \InvalidArgumentException('non-nullable district cannot be null');
        }
        $this->container['district'] = $district;

        return $this;
    }

    /**
     * Gets city
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->container['city'];
    }

    /**
     * Sets city
     *
     * @param string|null $city city
     *
     * @return self
     */
    public function setCity($city)
    {
        if (is_null($city)) {
            throw new \InvalidArgumentException('non-nullable city cannot be null');
        }
        $this->container['city'] = $city;

        return $this;
    }

    /**
     * Gets locality
     *
     * @return string|null
     */
    public function getLocality()
    {
        return $this->container['locality'];
    }

    /**
     * Sets locality
     *
     * @param string|null $locality locality
     *
     * @return self
     */
    public function setLocality($locality)
    {
        if (is_null($locality)) {
            throw new \InvalidArgumentException('non-nullable locality cannot be null');
        }
        $this->container['locality'] = $locality;

        return $this;
    }

    /**
     * Gets zipcode
     *
     * @return string|null
     */
    public function getZipcode()
    {
        return $this->container['zipcode'];
    }

    /**
     * Sets zipcode
     *
     * @param string|null $zipcode zipcode
     *
     * @return self
     */
    public function setZipcode($zipcode)
    {
        if (is_null($zipcode)) {
            throw new \InvalidArgumentException('non-nullable zipcode cannot be null');
        }
        $this->container['zipcode'] = $zipcode;

        return $this;
    }

    /**
     * Gets latitude
     *
     * @return string|null
     */
    public function getLatitude()
    {
        return $this->container['latitude'];
    }

    /**
     * Sets latitude
     *
     * @param string|null $latitude latitude
     *
     * @return self
     */
    public function setLatitude($latitude)
    {
        if (is_null($latitude)) {
            throw new \InvalidArgumentException('non-nullable latitude cannot be null');
        }
        $this->container['latitude'] = $latitude;

        return $this;
    }

    /**
     * Gets longitude
     *
     * @return string|null
     */
    public function getLongitude()
    {
        return $this->container['longitude'];
    }

    /**
     * Sets longitude
     *
     * @param string|null $longitude longitude
     *
     * @return self
     */
    public function setLongitude($longitude)
    {
        if (is_null($longitude)) {
            throw new \InvalidArgumentException('non-nullable longitude cannot be null');
        }
        $this->container['longitude'] = $longitude;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


