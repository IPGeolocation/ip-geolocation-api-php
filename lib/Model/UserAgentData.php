<?php
/**
 * UserAgentData
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
 * UserAgentData Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 * @implements \ArrayAccess<string, mixed>
 */
class UserAgentData implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $ipgeoapiModelName = 'UserAgentData';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $ipgeoapiTypes = [
        'user_agent_string' => 'string',
        'name' => 'string',
        'type' => 'string',
        'version' => 'string',
        'version_major' => 'string',
        'device' => '\Ipgeolocation\Sdk\\Model\UserAgentDataDevice',
        'engine' => '\Ipgeolocation\Sdk\\Model\UserAgentDataEngine',
        'operating_system' => '\Ipgeolocation\Sdk\\Model\UserAgentDataOperatingSystem'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $ipgeoapiFormats = [
        'user_agent_string' => null,
        'name' => null,
        'type' => null,
        'version' => null,
        'version_major' => null,
        'device' => null,
        'engine' => null,
        'operating_system' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $ipgeoapiNullables = [
        'user_agent_string' => false,
        'name' => false,
        'type' => false,
        'version' => false,
        'version_major' => false,
        'device' => false,
        'engine' => false,
        'operating_system' => false
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
        'user_agent_string' => 'user_agent_string',
        'name' => 'name',
        'type' => 'type',
        'version' => 'version',
        'version_major' => 'version_major',
        'device' => 'device',
        'engine' => 'engine',
        'operating_system' => 'operating_system'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'user_agent_string' => 'setUserAgentString',
        'name' => 'setName',
        'type' => 'setType',
        'version' => 'setVersion',
        'version_major' => 'setVersionMajor',
        'device' => 'setDevice',
        'engine' => 'setEngine',
        'operating_system' => 'setOperatingSystem'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'user_agent_string' => 'getUserAgentString',
        'name' => 'getName',
        'type' => 'getType',
        'version' => 'getVersion',
        'version_major' => 'getVersionMajor',
        'device' => 'getDevice',
        'engine' => 'getEngine',
        'operating_system' => 'getOperatingSystem'
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
        $this->setIfExists('user_agent_string', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('version', $data ?? [], null);
        $this->setIfExists('version_major', $data ?? [], null);
        $this->setIfExists('device', $data ?? [], null);
        $this->setIfExists('engine', $data ?? [], null);
        $this->setIfExists('operating_system', $data ?? [], null);
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
     * Gets user_agent_string
     *
     * @return string|null
     */
    public function getUserAgentString()
    {
        return $this->container['user_agent_string'];
    }

    /**
     * Sets user_agent_string
     *
     * @param string|null $user_agent_string user_agent_string
     *
     * @return self
     */
    public function setUserAgentString($user_agent_string)
    {
        if (is_null($user_agent_string)) {
            throw new \InvalidArgumentException('non-nullable user_agent_string cannot be null');
        }
        $this->container['user_agent_string'] = $user_agent_string;

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
     * Gets version
     *
     * @return string|null
     */
    public function getVersion()
    {
        return $this->container['version'];
    }

    /**
     * Sets version
     *
     * @param string|null $version version
     *
     * @return self
     */
    public function setVersion($version)
    {
        if (is_null($version)) {
            throw new \InvalidArgumentException('non-nullable version cannot be null');
        }
        $this->container['version'] = $version;

        return $this;
    }

    /**
     * Gets version_major
     *
     * @return string|null
     */
    public function getVersionMajor()
    {
        return $this->container['version_major'];
    }

    /**
     * Sets version_major
     *
     * @param string|null $version_major version_major
     *
     * @return self
     */
    public function setVersionMajor($version_major)
    {
        if (is_null($version_major)) {
            throw new \InvalidArgumentException('non-nullable version_major cannot be null');
        }
        $this->container['version_major'] = $version_major;

        return $this;
    }

    /**
     * Gets device
     *
     * @return \Ipgeolocation\Sdk\\Model\UserAgentDataDevice|null
     */
    public function getDevice()
    {
        return $this->container['device'];
    }

    /**
     * Sets device
     *
     * @param \Ipgeolocation\Sdk\\Model\UserAgentDataDevice|null $device device
     *
     * @return self
     */
    public function setDevice($device)
    {
        if (is_null($device)) {
            throw new \InvalidArgumentException('non-nullable device cannot be null');
        }
        $this->container['device'] = $device;

        return $this;
    }

    /**
     * Gets engine
     *
     * @return \Ipgeolocation\Sdk\\Model\UserAgentDataEngine|null
     */
    public function getEngine()
    {
        return $this->container['engine'];
    }

    /**
     * Sets engine
     *
     * @param \Ipgeolocation\Sdk\\Model\UserAgentDataEngine|null $engine engine
     *
     * @return self
     */
    public function setEngine($engine)
    {
        if (is_null($engine)) {
            throw new \InvalidArgumentException('non-nullable engine cannot be null');
        }
        $this->container['engine'] = $engine;

        return $this;
    }

    /**
     * Gets operating_system
     *
     * @return \Ipgeolocation\Sdk\\Model\UserAgentDataOperatingSystem|null
     */
    public function getOperatingSystem()
    {
        return $this->container['operating_system'];
    }

    /**
     * Sets operating_system
     *
     * @param \Ipgeolocation\Sdk\\Model\UserAgentDataOperatingSystem|null $operating_system operating_system
     *
     * @return self
     */
    public function setOperatingSystem($operating_system)
    {
        if (is_null($operating_system)) {
            throw new \InvalidArgumentException('non-nullable operating_system cannot be null');
        }
        $this->container['operating_system'] = $operating_system;

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


