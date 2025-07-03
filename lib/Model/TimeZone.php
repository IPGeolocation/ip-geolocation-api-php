<?php
/**
 * TimeZone
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
 * TimeZone Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 * @implements \ArrayAccess<string, mixed>
 */
class TimeZone implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $ipgeoapiModelName = 'TimeZone';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $ipgeoapiTypes = [
        'name' => 'string',
        'offset' => 'int',
        'offset_with_dst' => 'int',
        'current_time' => 'string',
        'current_time_unix' => 'float',
        'is_dst' => 'bool',
        'dst_savings' => 'int',
        'dst_exists' => 'bool',
        'dst_start' => '\Ipgeolocation\Sdk\\Model\TimeZoneDstStart',
        'dst_end' => '\Ipgeolocation\Sdk\\Model\TimeZoneDstEnd'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $ipgeoapiFormats = [
        'name' => null,
        'offset' => null,
        'offset_with_dst' => null,
        'current_time' => null,
        'current_time_unix' => null,
        'is_dst' => null,
        'dst_savings' => null,
        'dst_exists' => null,
        'dst_start' => null,
        'dst_end' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $ipgeoapiNullables = [
        'name' => false,
        'offset' => false,
        'offset_with_dst' => false,
        'current_time' => false,
        'current_time_unix' => false,
        'is_dst' => false,
        'dst_savings' => false,
        'dst_exists' => false,
        'dst_start' => false,
        'dst_end' => false
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
        'name' => 'name',
        'offset' => 'offset',
        'offset_with_dst' => 'offset_with_dst',
        'current_time' => 'current_time',
        'current_time_unix' => 'current_time_unix',
        'is_dst' => 'is_dst',
        'dst_savings' => 'dst_savings',
        'dst_exists' => 'dst_exists',
        'dst_start' => 'dst_start',
        'dst_end' => 'dst_end'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'offset' => 'setOffset',
        'offset_with_dst' => 'setOffsetWithDst',
        'current_time' => 'setCurrentTime',
        'current_time_unix' => 'setCurrentTimeUnix',
        'is_dst' => 'setIsDst',
        'dst_savings' => 'setDstSavings',
        'dst_exists' => 'setDstExists',
        'dst_start' => 'setDstStart',
        'dst_end' => 'setDstEnd'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'offset' => 'getOffset',
        'offset_with_dst' => 'getOffsetWithDst',
        'current_time' => 'getCurrentTime',
        'current_time_unix' => 'getCurrentTimeUnix',
        'is_dst' => 'getIsDst',
        'dst_savings' => 'getDstSavings',
        'dst_exists' => 'getDstExists',
        'dst_start' => 'getDstStart',
        'dst_end' => 'getDstEnd'
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('offset', $data ?? [], null);
        $this->setIfExists('offset_with_dst', $data ?? [], null);
        $this->setIfExists('current_time', $data ?? [], null);
        $this->setIfExists('current_time_unix', $data ?? [], null);
        $this->setIfExists('is_dst', $data ?? [], null);
        $this->setIfExists('dst_savings', $data ?? [], null);
        $this->setIfExists('dst_exists', $data ?? [], null);
        $this->setIfExists('dst_start', $data ?? [], null);
        $this->setIfExists('dst_end', $data ?? [], null);
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
     * Gets offset
     *
     * @return int|null
     */
    public function getOffset()
    {
        return $this->container['offset'];
    }

    /**
     * Sets offset
     *
     * @param int|null $offset offset
     *
     * @return self
     */
    public function setOffset($offset)
    {
        if (is_null($offset)) {
            throw new \InvalidArgumentException('non-nullable offset cannot be null');
        }
        $this->container['offset'] = $offset;

        return $this;
    }

    /**
     * Gets offset_with_dst
     *
     * @return int|null
     */
    public function getOffsetWithDst()
    {
        return $this->container['offset_with_dst'];
    }

    /**
     * Sets offset_with_dst
     *
     * @param int|null $offset_with_dst offset_with_dst
     *
     * @return self
     */
    public function setOffsetWithDst($offset_with_dst)
    {
        if (is_null($offset_with_dst)) {
            throw new \InvalidArgumentException('non-nullable offset_with_dst cannot be null');
        }
        $this->container['offset_with_dst'] = $offset_with_dst;

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
     * Gets current_time_unix
     *
     * @return float|null
     */
    public function getCurrentTimeUnix()
    {
        return $this->container['current_time_unix'];
    }

    /**
     * Sets current_time_unix
     *
     * @param float|null $current_time_unix current_time_unix
     *
     * @return self
     */
    public function setCurrentTimeUnix($current_time_unix)
    {
        if (is_null($current_time_unix)) {
            throw new \InvalidArgumentException('non-nullable current_time_unix cannot be null');
        }
        $this->container['current_time_unix'] = $current_time_unix;

        return $this;
    }

    /**
     * Gets is_dst
     *
     * @return bool|null
     */
    public function getIsDst()
    {
        return $this->container['is_dst'];
    }

    /**
     * Sets is_dst
     *
     * @param bool|null $is_dst is_dst
     *
     * @return self
     */
    public function setIsDst($is_dst)
    {
        if (is_null($is_dst)) {
            throw new \InvalidArgumentException('non-nullable is_dst cannot be null');
        }
        $this->container['is_dst'] = $is_dst;

        return $this;
    }

    /**
     * Gets dst_savings
     *
     * @return int|null
     */
    public function getDstSavings()
    {
        return $this->container['dst_savings'];
    }

    /**
     * Sets dst_savings
     *
     * @param int|null $dst_savings dst_savings
     *
     * @return self
     */
    public function setDstSavings($dst_savings)
    {
        if (is_null($dst_savings)) {
            throw new \InvalidArgumentException('non-nullable dst_savings cannot be null');
        }
        $this->container['dst_savings'] = $dst_savings;

        return $this;
    }

    /**
     * Gets dst_exists
     *
     * @return bool|null
     */
    public function getDstExists()
    {
        return $this->container['dst_exists'];
    }

    /**
     * Sets dst_exists
     *
     * @param bool|null $dst_exists dst_exists
     *
     * @return self
     */
    public function setDstExists($dst_exists)
    {
        if (is_null($dst_exists)) {
            throw new \InvalidArgumentException('non-nullable dst_exists cannot be null');
        }
        $this->container['dst_exists'] = $dst_exists;

        return $this;
    }

    /**
     * Gets dst_start
     *
     * @return \Ipgeolocation\Sdk\\Model\TimeZoneDstStart|null
     */
    public function getDstStart()
    {
        return $this->container['dst_start'];
    }

    /**
     * Sets dst_start
     *
     * @param \Ipgeolocation\Sdk\\Model\TimeZoneDstStart|null $dst_start dst_start
     *
     * @return self
     */
    public function setDstStart($dst_start)
    {
        if (is_null($dst_start)) {
            throw new \InvalidArgumentException('non-nullable dst_start cannot be null');
        }
        $this->container['dst_start'] = $dst_start;

        return $this;
    }

    /**
     * Gets dst_end
     *
     * @return \Ipgeolocation\Sdk\\Model\TimeZoneDstEnd|null
     */
    public function getDstEnd()
    {
        return $this->container['dst_end'];
    }

    /**
     * Sets dst_end
     *
     * @param \Ipgeolocation\Sdk\\Model\TimeZoneDstEnd|null $dst_end dst_end
     *
     * @return self
     */
    public function setDstEnd($dst_end)
    {
        if (is_null($dst_end)) {
            throw new \InvalidArgumentException('non-nullable dst_end cannot be null');
        }
        $this->container['dst_end'] = $dst_end;

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


