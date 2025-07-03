<?php
/**
 * TimeZoneDstStart
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
 * TimeZoneDstStart Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 * @implements \ArrayAccess<string, mixed>
 */
class TimeZoneDstStart implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $ipgeoapiModelName = 'TimeZone_dst_start';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $ipgeoapiTypes = [
        'utc_time' => 'string',
        'duration' => 'string',
        'gap' => 'bool',
        'date_time_after' => 'string',
        'date_time_before' => 'string',
        'overlap' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $ipgeoapiFormats = [
        'utc_time' => null,
        'duration' => null,
        'gap' => null,
        'date_time_after' => null,
        'date_time_before' => null,
        'overlap' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $ipgeoapiNullables = [
        'utc_time' => false,
        'duration' => false,
        'gap' => false,
        'date_time_after' => false,
        'date_time_before' => false,
        'overlap' => false
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
        'utc_time' => 'utc_time',
        'duration' => 'duration',
        'gap' => 'gap',
        'date_time_after' => 'date_time_after',
        'date_time_before' => 'date_time_before',
        'overlap' => 'overlap'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'utc_time' => 'setUtcTime',
        'duration' => 'setDuration',
        'gap' => 'setGap',
        'date_time_after' => 'setDateTimeAfter',
        'date_time_before' => 'setDateTimeBefore',
        'overlap' => 'setOverlap'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'utc_time' => 'getUtcTime',
        'duration' => 'getDuration',
        'gap' => 'getGap',
        'date_time_after' => 'getDateTimeAfter',
        'date_time_before' => 'getDateTimeBefore',
        'overlap' => 'getOverlap'
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
        $this->setIfExists('utc_time', $data ?? [], null);
        $this->setIfExists('duration', $data ?? [], null);
        $this->setIfExists('gap', $data ?? [], null);
        $this->setIfExists('date_time_after', $data ?? [], null);
        $this->setIfExists('date_time_before', $data ?? [], null);
        $this->setIfExists('overlap', $data ?? [], null);
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
     * Gets utc_time
     *
     * @return string|null
     */
    public function getUtcTime()
    {
        return $this->container['utc_time'];
    }

    /**
     * Sets utc_time
     *
     * @param string|null $utc_time utc_time
     *
     * @return self
     */
    public function setUtcTime($utc_time)
    {
        if (is_null($utc_time)) {
            throw new \InvalidArgumentException('non-nullable utc_time cannot be null');
        }
        $this->container['utc_time'] = $utc_time;

        return $this;
    }

    /**
     * Gets duration
     *
     * @return string|null
     */
    public function getDuration()
    {
        return $this->container['duration'];
    }

    /**
     * Sets duration
     *
     * @param string|null $duration duration
     *
     * @return self
     */
    public function setDuration($duration)
    {
        if (is_null($duration)) {
            throw new \InvalidArgumentException('non-nullable duration cannot be null');
        }
        $this->container['duration'] = $duration;

        return $this;
    }

    /**
     * Gets gap
     *
     * @return bool|null
     */
    public function getGap()
    {
        return $this->container['gap'];
    }

    /**
     * Sets gap
     *
     * @param bool|null $gap gap
     *
     * @return self
     */
    public function setGap($gap)
    {
        if (is_null($gap)) {
            throw new \InvalidArgumentException('non-nullable gap cannot be null');
        }
        $this->container['gap'] = $gap;

        return $this;
    }

    /**
     * Gets date_time_after
     *
     * @return string|null
     */
    public function getDateTimeAfter()
    {
        return $this->container['date_time_after'];
    }

    /**
     * Sets date_time_after
     *
     * @param string|null $date_time_after date_time_after
     *
     * @return self
     */
    public function setDateTimeAfter($date_time_after)
    {
        if (is_null($date_time_after)) {
            throw new \InvalidArgumentException('non-nullable date_time_after cannot be null');
        }
        $this->container['date_time_after'] = $date_time_after;

        return $this;
    }

    /**
     * Gets date_time_before
     *
     * @return string|null
     */
    public function getDateTimeBefore()
    {
        return $this->container['date_time_before'];
    }

    /**
     * Sets date_time_before
     *
     * @param string|null $date_time_before date_time_before
     *
     * @return self
     */
    public function setDateTimeBefore($date_time_before)
    {
        if (is_null($date_time_before)) {
            throw new \InvalidArgumentException('non-nullable date_time_before cannot be null');
        }
        $this->container['date_time_before'] = $date_time_before;

        return $this;
    }

    /**
     * Gets overlap
     *
     * @return bool|null
     */
    public function getOverlap()
    {
        return $this->container['overlap'];
    }

    /**
     * Sets overlap
     *
     * @param bool|null $overlap overlap
     *
     * @return self
     */
    public function setOverlap($overlap)
    {
        if (is_null($overlap)) {
            throw new \InvalidArgumentException('non-nullable overlap cannot be null');
        }
        $this->container['overlap'] = $overlap;

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


