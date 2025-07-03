<?php
/**
 * Astronomy
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
 * Astronomy Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 * @implements \ArrayAccess<string, mixed>
 */
class Astronomy implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $ipgeoapiModelName = 'Astronomy';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $ipgeoapiTypes = [
        'date' => '\DateTime',
        'current_time' => 'string',
        'sunrise' => 'string',
        'sunset' => 'string',
        'sun_status' => 'string',
        'solar_noon' => 'string',
        'day_length' => 'string',
        'sun_altitude' => 'float',
        'sun_distance' => 'float',
        'sun_azimuth' => 'float',
        'moonrise' => 'string',
        'moonset' => 'string',
        'moon_status' => 'string',
        'moon_altitude' => 'float',
        'moon_distance' => 'float',
        'moon_azimuth' => 'float',
        'moon_parallactic_angle' => 'float',
        'moon_phase' => 'string',
        'moon_illumination_percentage' => 'string',
        'moon_angle' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $ipgeoapiFormats = [
        'date' => 'date',
        'current_time' => 'time',
        'sunrise' => null,
        'sunset' => null,
        'sun_status' => null,
        'solar_noon' => null,
        'day_length' => null,
        'sun_altitude' => null,
        'sun_distance' => null,
        'sun_azimuth' => null,
        'moonrise' => null,
        'moonset' => null,
        'moon_status' => null,
        'moon_altitude' => null,
        'moon_distance' => null,
        'moon_azimuth' => null,
        'moon_parallactic_angle' => null,
        'moon_phase' => null,
        'moon_illumination_percentage' => null,
        'moon_angle' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $ipgeoapiNullables = [
        'date' => false,
        'current_time' => false,
        'sunrise' => false,
        'sunset' => false,
        'sun_status' => false,
        'solar_noon' => false,
        'day_length' => false,
        'sun_altitude' => false,
        'sun_distance' => false,
        'sun_azimuth' => false,
        'moonrise' => false,
        'moonset' => false,
        'moon_status' => false,
        'moon_altitude' => false,
        'moon_distance' => false,
        'moon_azimuth' => false,
        'moon_parallactic_angle' => false,
        'moon_phase' => false,
        'moon_illumination_percentage' => false,
        'moon_angle' => false
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
        'date' => 'date',
        'current_time' => 'current_time',
        'sunrise' => 'sunrise',
        'sunset' => 'sunset',
        'sun_status' => 'sun_status',
        'solar_noon' => 'solar_noon',
        'day_length' => 'day_length',
        'sun_altitude' => 'sun_altitude',
        'sun_distance' => 'sun_distance',
        'sun_azimuth' => 'sun_azimuth',
        'moonrise' => 'moonrise',
        'moonset' => 'moonset',
        'moon_status' => 'moon_status',
        'moon_altitude' => 'moon_altitude',
        'moon_distance' => 'moon_distance',
        'moon_azimuth' => 'moon_azimuth',
        'moon_parallactic_angle' => 'moon_parallactic_angle',
        'moon_phase' => 'moon_phase',
        'moon_illumination_percentage' => 'moon_illumination_percentage',
        'moon_angle' => 'moon_angle'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'date' => 'setDate',
        'current_time' => 'setCurrentTime',
        'sunrise' => 'setSunrise',
        'sunset' => 'setSunset',
        'sun_status' => 'setSunStatus',
        'solar_noon' => 'setSolarNoon',
        'day_length' => 'setDayLength',
        'sun_altitude' => 'setSunAltitude',
        'sun_distance' => 'setSunDistance',
        'sun_azimuth' => 'setSunAzimuth',
        'moonrise' => 'setMoonrise',
        'moonset' => 'setMoonset',
        'moon_status' => 'setMoonStatus',
        'moon_altitude' => 'setMoonAltitude',
        'moon_distance' => 'setMoonDistance',
        'moon_azimuth' => 'setMoonAzimuth',
        'moon_parallactic_angle' => 'setMoonParallacticAngle',
        'moon_phase' => 'setMoonPhase',
        'moon_illumination_percentage' => 'setMoonIlluminationPercentage',
        'moon_angle' => 'setMoonAngle'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'date' => 'getDate',
        'current_time' => 'getCurrentTime',
        'sunrise' => 'getSunrise',
        'sunset' => 'getSunset',
        'sun_status' => 'getSunStatus',
        'solar_noon' => 'getSolarNoon',
        'day_length' => 'getDayLength',
        'sun_altitude' => 'getSunAltitude',
        'sun_distance' => 'getSunDistance',
        'sun_azimuth' => 'getSunAzimuth',
        'moonrise' => 'getMoonrise',
        'moonset' => 'getMoonset',
        'moon_status' => 'getMoonStatus',
        'moon_altitude' => 'getMoonAltitude',
        'moon_distance' => 'getMoonDistance',
        'moon_azimuth' => 'getMoonAzimuth',
        'moon_parallactic_angle' => 'getMoonParallacticAngle',
        'moon_phase' => 'getMoonPhase',
        'moon_illumination_percentage' => 'getMoonIlluminationPercentage',
        'moon_angle' => 'getMoonAngle'
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
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('current_time', $data ?? [], null);
        $this->setIfExists('sunrise', $data ?? [], null);
        $this->setIfExists('sunset', $data ?? [], null);
        $this->setIfExists('sun_status', $data ?? [], null);
        $this->setIfExists('solar_noon', $data ?? [], null);
        $this->setIfExists('day_length', $data ?? [], null);
        $this->setIfExists('sun_altitude', $data ?? [], null);
        $this->setIfExists('sun_distance', $data ?? [], null);
        $this->setIfExists('sun_azimuth', $data ?? [], null);
        $this->setIfExists('moonrise', $data ?? [], null);
        $this->setIfExists('moonset', $data ?? [], null);
        $this->setIfExists('moon_status', $data ?? [], null);
        $this->setIfExists('moon_altitude', $data ?? [], null);
        $this->setIfExists('moon_distance', $data ?? [], null);
        $this->setIfExists('moon_azimuth', $data ?? [], null);
        $this->setIfExists('moon_parallactic_angle', $data ?? [], null);
        $this->setIfExists('moon_phase', $data ?? [], null);
        $this->setIfExists('moon_illumination_percentage', $data ?? [], null);
        $this->setIfExists('moon_angle', $data ?? [], null);
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
     * Gets date
     *
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param \DateTime|null $date date
     *
     * @return self
     */
    public function setDate($date)
    {
        if (is_null($date)) {
            throw new \InvalidArgumentException('non-nullable date cannot be null');
        }
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets current_time
     *
     * @return string|null
     */
    public function getCurrentTime()
    {
        return $this->container['current_time'];
    }

    /**
     * Sets current_time
     *
     * @param string|null $current_time current_time
     *
     * @return self
     */
    public function setCurrentTime($current_time)
    {
        if (is_null($current_time)) {
            throw new \InvalidArgumentException('non-nullable current_time cannot be null');
        }
        $this->container['current_time'] = $current_time;

        return $this;
    }

    /**
     * Gets sunrise
     *
     * @return string|null
     */
    public function getSunrise()
    {
        return $this->container['sunrise'];
    }

    /**
     * Sets sunrise
     *
     * @param string|null $sunrise sunrise
     *
     * @return self
     */
    public function setSunrise($sunrise)
    {
        if (is_null($sunrise)) {
            throw new \InvalidArgumentException('non-nullable sunrise cannot be null');
        }
        $this->container['sunrise'] = $sunrise;

        return $this;
    }

    /**
     * Gets sunset
     *
     * @return string|null
     */
    public function getSunset()
    {
        return $this->container['sunset'];
    }

    /**
     * Sets sunset
     *
     * @param string|null $sunset sunset
     *
     * @return self
     */
    public function setSunset($sunset)
    {
        if (is_null($sunset)) {
            throw new \InvalidArgumentException('non-nullable sunset cannot be null');
        }
        $this->container['sunset'] = $sunset;

        return $this;
    }

    /**
     * Gets sun_status
     *
     * @return string|null
     */
    public function getSunStatus()
    {
        return $this->container['sun_status'];
    }

    /**
     * Sets sun_status
     *
     * @param string|null $sun_status sun_status
     *
     * @return self
     */
    public function setSunStatus($sun_status)
    {
        if (is_null($sun_status)) {
            throw new \InvalidArgumentException('non-nullable sun_status cannot be null');
        }
        $this->container['sun_status'] = $sun_status;

        return $this;
    }

    /**
     * Gets solar_noon
     *
     * @return string|null
     */
    public function getSolarNoon()
    {
        return $this->container['solar_noon'];
    }

    /**
     * Sets solar_noon
     *
     * @param string|null $solar_noon solar_noon
     *
     * @return self
     */
    public function setSolarNoon($solar_noon)
    {
        if (is_null($solar_noon)) {
            throw new \InvalidArgumentException('non-nullable solar_noon cannot be null');
        }
        $this->container['solar_noon'] = $solar_noon;

        return $this;
    }

    /**
     * Gets day_length
     *
     * @return string|null
     */
    public function getDayLength()
    {
        return $this->container['day_length'];
    }

    /**
     * Sets day_length
     *
     * @param string|null $day_length day_length
     *
     * @return self
     */
    public function setDayLength($day_length)
    {
        if (is_null($day_length)) {
            throw new \InvalidArgumentException('non-nullable day_length cannot be null');
        }
        $this->container['day_length'] = $day_length;

        return $this;
    }

    /**
     * Gets sun_altitude
     *
     * @return float|null
     */
    public function getSunAltitude()
    {
        return $this->container['sun_altitude'];
    }

    /**
     * Sets sun_altitude
     *
     * @param float|null $sun_altitude sun_altitude
     *
     * @return self
     */
    public function setSunAltitude($sun_altitude)
    {
        if (is_null($sun_altitude)) {
            throw new \InvalidArgumentException('non-nullable sun_altitude cannot be null');
        }
        $this->container['sun_altitude'] = $sun_altitude;

        return $this;
    }

    /**
     * Gets sun_distance
     *
     * @return float|null
     */
    public function getSunDistance()
    {
        return $this->container['sun_distance'];
    }

    /**
     * Sets sun_distance
     *
     * @param float|null $sun_distance sun_distance
     *
     * @return self
     */
    public function setSunDistance($sun_distance)
    {
        if (is_null($sun_distance)) {
            throw new \InvalidArgumentException('non-nullable sun_distance cannot be null');
        }
        $this->container['sun_distance'] = $sun_distance;

        return $this;
    }

    /**
     * Gets sun_azimuth
     *
     * @return float|null
     */
    public function getSunAzimuth()
    {
        return $this->container['sun_azimuth'];
    }

    /**
     * Sets sun_azimuth
     *
     * @param float|null $sun_azimuth sun_azimuth
     *
     * @return self
     */
    public function setSunAzimuth($sun_azimuth)
    {
        if (is_null($sun_azimuth)) {
            throw new \InvalidArgumentException('non-nullable sun_azimuth cannot be null');
        }
        $this->container['sun_azimuth'] = $sun_azimuth;

        return $this;
    }

    /**
     * Gets moonrise
     *
     * @return string|null
     */
    public function getMoonrise()
    {
        return $this->container['moonrise'];
    }

    /**
     * Sets moonrise
     *
     * @param string|null $moonrise moonrise
     *
     * @return self
     */
    public function setMoonrise($moonrise)
    {
        if (is_null($moonrise)) {
            throw new \InvalidArgumentException('non-nullable moonrise cannot be null');
        }
        $this->container['moonrise'] = $moonrise;

        return $this;
    }

    /**
     * Gets moonset
     *
     * @return string|null
     */
    public function getMoonset()
    {
        return $this->container['moonset'];
    }

    /**
     * Sets moonset
     *
     * @param string|null $moonset moonset
     *
     * @return self
     */
    public function setMoonset($moonset)
    {
        if (is_null($moonset)) {
            throw new \InvalidArgumentException('non-nullable moonset cannot be null');
        }
        $this->container['moonset'] = $moonset;

        return $this;
    }

    /**
     * Gets moon_status
     *
     * @return string|null
     */
    public function getMoonStatus()
    {
        return $this->container['moon_status'];
    }

    /**
     * Sets moon_status
     *
     * @param string|null $moon_status moon_status
     *
     * @return self
     */
    public function setMoonStatus($moon_status)
    {
        if (is_null($moon_status)) {
            throw new \InvalidArgumentException('non-nullable moon_status cannot be null');
        }
        $this->container['moon_status'] = $moon_status;

        return $this;
    }

    /**
     * Gets moon_altitude
     *
     * @return float|null
     */
    public function getMoonAltitude()
    {
        return $this->container['moon_altitude'];
    }

    /**
     * Sets moon_altitude
     *
     * @param float|null $moon_altitude moon_altitude
     *
     * @return self
     */
    public function setMoonAltitude($moon_altitude)
    {
        if (is_null($moon_altitude)) {
            throw new \InvalidArgumentException('non-nullable moon_altitude cannot be null');
        }
        $this->container['moon_altitude'] = $moon_altitude;

        return $this;
    }

    /**
     * Gets moon_distance
     *
     * @return float|null
     */
    public function getMoonDistance()
    {
        return $this->container['moon_distance'];
    }

    /**
     * Sets moon_distance
     *
     * @param float|null $moon_distance moon_distance
     *
     * @return self
     */
    public function setMoonDistance($moon_distance)
    {
        if (is_null($moon_distance)) {
            throw new \InvalidArgumentException('non-nullable moon_distance cannot be null');
        }
        $this->container['moon_distance'] = $moon_distance;

        return $this;
    }

    /**
     * Gets moon_azimuth
     *
     * @return float|null
     */
    public function getMoonAzimuth()
    {
        return $this->container['moon_azimuth'];
    }

    /**
     * Sets moon_azimuth
     *
     * @param float|null $moon_azimuth moon_azimuth
     *
     * @return self
     */
    public function setMoonAzimuth($moon_azimuth)
    {
        if (is_null($moon_azimuth)) {
            throw new \InvalidArgumentException('non-nullable moon_azimuth cannot be null');
        }
        $this->container['moon_azimuth'] = $moon_azimuth;

        return $this;
    }

    /**
     * Gets moon_parallactic_angle
     *
     * @return float|null
     */
    public function getMoonParallacticAngle()
    {
        return $this->container['moon_parallactic_angle'];
    }

    /**
     * Sets moon_parallactic_angle
     *
     * @param float|null $moon_parallactic_angle moon_parallactic_angle
     *
     * @return self
     */
    public function setMoonParallacticAngle($moon_parallactic_angle)
    {
        if (is_null($moon_parallactic_angle)) {
            throw new \InvalidArgumentException('non-nullable moon_parallactic_angle cannot be null');
        }
        $this->container['moon_parallactic_angle'] = $moon_parallactic_angle;

        return $this;
    }

    /**
     * Gets moon_phase
     *
     * @return string|null
     */
    public function getMoonPhase()
    {
        return $this->container['moon_phase'];
    }

    /**
     * Sets moon_phase
     *
     * @param string|null $moon_phase moon_phase
     *
     * @return self
     */
    public function setMoonPhase($moon_phase)
    {
        if (is_null($moon_phase)) {
            throw new \InvalidArgumentException('non-nullable moon_phase cannot be null');
        }
        $this->container['moon_phase'] = $moon_phase;

        return $this;
    }

    /**
     * Gets moon_illumination_percentage
     *
     * @return string|null
     */
    public function getMoonIlluminationPercentage()
    {
        return $this->container['moon_illumination_percentage'];
    }

    /**
     * Sets moon_illumination_percentage
     *
     * @param string|null $moon_illumination_percentage moon_illumination_percentage
     *
     * @return self
     */
    public function setMoonIlluminationPercentage($moon_illumination_percentage)
    {
        if (is_null($moon_illumination_percentage)) {
            throw new \InvalidArgumentException('non-nullable moon_illumination_percentage cannot be null');
        }
        $this->container['moon_illumination_percentage'] = $moon_illumination_percentage;

        return $this;
    }

    /**
     * Gets moon_angle
     *
     * @return float|null
     */
    public function getMoonAngle()
    {
        return $this->container['moon_angle'];
    }

    /**
     * Sets moon_angle
     *
     * @param float|null $moon_angle moon_angle
     *
     * @return self
     */
    public function setMoonAngle($moon_angle)
    {
        if (is_null($moon_angle)) {
            throw new \InvalidArgumentException('non-nullable moon_angle cannot be null');
        }
        $this->container['moon_angle'] = $moon_angle;

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


