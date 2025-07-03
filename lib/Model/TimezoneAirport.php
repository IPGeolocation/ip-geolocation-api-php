<?php
/**
 * TimezoneAirport
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
 * TimezoneAirport Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 * @implements \ArrayAccess<string, mixed>
 */
class TimezoneAirport implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $ipgeoapiModelName = 'TimezoneAirport';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $ipgeoapiTypes = [
        'type' => 'string',
        'name' => 'string',
        'latitude' => 'string',
        'longitude' => 'string',
        'elevation_ft' => 'int',
        'continent_code' => 'string',
        'country_code' => 'string',
        'state_code' => 'string',
        'city' => 'string',
        'iata_code' => 'string',
        'icao_code' => 'string',
        'faa_code' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $ipgeoapiFormats = [
        'type' => null,
        'name' => null,
        'latitude' => null,
        'longitude' => null,
        'elevation_ft' => null,
        'continent_code' => null,
        'country_code' => null,
        'state_code' => null,
        'city' => null,
        'iata_code' => null,
        'icao_code' => null,
        'faa_code' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $ipgeoapiNullables = [
        'type' => false,
        'name' => false,
        'latitude' => false,
        'longitude' => false,
        'elevation_ft' => false,
        'continent_code' => false,
        'country_code' => false,
        'state_code' => false,
        'city' => false,
        'iata_code' => false,
        'icao_code' => false,
        'faa_code' => false
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
        'type' => 'type',
        'name' => 'name',
        'latitude' => 'latitude',
        'longitude' => 'longitude',
        'elevation_ft' => 'elevation_ft',
        'continent_code' => 'continent_code',
        'country_code' => 'country_code',
        'state_code' => 'state_code',
        'city' => 'city',
        'iata_code' => 'iata_code',
        'icao_code' => 'icao_code',
        'faa_code' => 'faa_code'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'type' => 'setType',
        'name' => 'setName',
        'latitude' => 'setLatitude',
        'longitude' => 'setLongitude',
        'elevation_ft' => 'setElevationFt',
        'continent_code' => 'setContinentCode',
        'country_code' => 'setCountryCode',
        'state_code' => 'setStateCode',
        'city' => 'setCity',
        'iata_code' => 'setIataCode',
        'icao_code' => 'setIcaoCode',
        'faa_code' => 'setFaaCode'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'type' => 'getType',
        'name' => 'getName',
        'latitude' => 'getLatitude',
        'longitude' => 'getLongitude',
        'elevation_ft' => 'getElevationFt',
        'continent_code' => 'getContinentCode',
        'country_code' => 'getCountryCode',
        'state_code' => 'getStateCode',
        'city' => 'getCity',
        'iata_code' => 'getIataCode',
        'icao_code' => 'getIcaoCode',
        'faa_code' => 'getFaaCode'
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
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('latitude', $data ?? [], null);
        $this->setIfExists('longitude', $data ?? [], null);
        $this->setIfExists('elevation_ft', $data ?? [], null);
        $this->setIfExists('continent_code', $data ?? [], null);
        $this->setIfExists('country_code', $data ?? [], null);
        $this->setIfExists('state_code', $data ?? [], null);
        $this->setIfExists('city', $data ?? [], null);
        $this->setIfExists('iata_code', $data ?? [], null);
        $this->setIfExists('icao_code', $data ?? [], null);
        $this->setIfExists('faa_code', $data ?? [], null);
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
     * Gets type
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string|null $type type
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

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
     * Gets elevation_ft
     *
     * @return int|null
     */
    public function getElevationFt()
    {
        return $this->container['elevation_ft'];
    }

    /**
     * Sets elevation_ft
     *
     * @param int|null $elevation_ft elevation_ft
     *
     * @return self
     */
    public function setElevationFt($elevation_ft)
    {
        if (is_null($elevation_ft)) {
            throw new \InvalidArgumentException('non-nullable elevation_ft cannot be null');
        }
        $this->container['elevation_ft'] = $elevation_ft;

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
     * Gets country_code
     *
     * @return string|null
     */
    public function getCountryCode()
    {
        return $this->container['country_code'];
    }

    /**
     * Sets country_code
     *
     * @param string|null $country_code country_code
     *
     * @return self
     */
    public function setCountryCode($country_code)
    {
        if (is_null($country_code)) {
            throw new \InvalidArgumentException('non-nullable country_code cannot be null');
        }
        $this->container['country_code'] = $country_code;

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
     * Gets iata_code
     *
     * @return string|null
     */
    public function getIataCode()
    {
        return $this->container['iata_code'];
    }

    /**
     * Sets iata_code
     *
     * @param string|null $iata_code iata_code
     *
     * @return self
     */
    public function setIataCode($iata_code)
    {
        if (is_null($iata_code)) {
            throw new \InvalidArgumentException('non-nullable iata_code cannot be null');
        }
        $this->container['iata_code'] = $iata_code;

        return $this;
    }

    /**
     * Gets icao_code
     *
     * @return string|null
     */
    public function getIcaoCode()
    {
        return $this->container['icao_code'];
    }

    /**
     * Sets icao_code
     *
     * @param string|null $icao_code icao_code
     *
     * @return self
     */
    public function setIcaoCode($icao_code)
    {
        if (is_null($icao_code)) {
            throw new \InvalidArgumentException('non-nullable icao_code cannot be null');
        }
        $this->container['icao_code'] = $icao_code;

        return $this;
    }

    /**
     * Gets faa_code
     *
     * @return string|null
     */
    public function getFaaCode()
    {
        return $this->container['faa_code'];
    }

    /**
     * Sets faa_code
     *
     * @param string|null $faa_code faa_code
     *
     * @return self
     */
    public function setFaaCode($faa_code)
    {
        if (is_null($faa_code)) {
            throw new \InvalidArgumentException('non-nullable faa_code cannot be null');
        }
        $this->container['faa_code'] = $faa_code;

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


