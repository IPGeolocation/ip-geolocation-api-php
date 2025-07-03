<?php
/**
 * Security
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
 * Security Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 * @implements \ArrayAccess<string, mixed>
 */
class Security implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $ipgeoapiModelName = 'Security';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $ipgeoapiTypes = [
        'threat_score' => 'int',
        'is_tor' => 'bool',
        'is_proxy' => 'bool',
        'proxy_type' => 'string',
        'proxy_provider' => 'string',
        'is_anonymous' => 'bool',
        'is_known_attacker' => 'bool',
        'is_spam' => 'bool',
        'is_bot' => 'bool',
        'is_cloud_provider' => 'bool',
        'cloud_provider' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $ipgeoapiFormats = [
        'threat_score' => null,
        'is_tor' => null,
        'is_proxy' => null,
        'proxy_type' => null,
        'proxy_provider' => null,
        'is_anonymous' => null,
        'is_known_attacker' => null,
        'is_spam' => null,
        'is_bot' => null,
        'is_cloud_provider' => null,
        'cloud_provider' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $ipgeoapiNullables = [
        'threat_score' => false,
        'is_tor' => false,
        'is_proxy' => false,
        'proxy_type' => false,
        'proxy_provider' => false,
        'is_anonymous' => false,
        'is_known_attacker' => false,
        'is_spam' => false,
        'is_bot' => false,
        'is_cloud_provider' => false,
        'cloud_provider' => false
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
        'threat_score' => 'threat_score',
        'is_tor' => 'is_tor',
        'is_proxy' => 'is_proxy',
        'proxy_type' => 'proxy_type',
        'proxy_provider' => 'proxy_provider',
        'is_anonymous' => 'is_anonymous',
        'is_known_attacker' => 'is_known_attacker',
        'is_spam' => 'is_spam',
        'is_bot' => 'is_bot',
        'is_cloud_provider' => 'is_cloud_provider',
        'cloud_provider' => 'cloud_provider'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'threat_score' => 'setThreatScore',
        'is_tor' => 'setIsTor',
        'is_proxy' => 'setIsProxy',
        'proxy_type' => 'setProxyType',
        'proxy_provider' => 'setProxyProvider',
        'is_anonymous' => 'setIsAnonymous',
        'is_known_attacker' => 'setIsKnownAttacker',
        'is_spam' => 'setIsSpam',
        'is_bot' => 'setIsBot',
        'is_cloud_provider' => 'setIsCloudProvider',
        'cloud_provider' => 'setCloudProvider'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'threat_score' => 'getThreatScore',
        'is_tor' => 'getIsTor',
        'is_proxy' => 'getIsProxy',
        'proxy_type' => 'getProxyType',
        'proxy_provider' => 'getProxyProvider',
        'is_anonymous' => 'getIsAnonymous',
        'is_known_attacker' => 'getIsKnownAttacker',
        'is_spam' => 'getIsSpam',
        'is_bot' => 'getIsBot',
        'is_cloud_provider' => 'getIsCloudProvider',
        'cloud_provider' => 'getCloudProvider'
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
        $this->setIfExists('threat_score', $data ?? [], null);
        $this->setIfExists('is_tor', $data ?? [], null);
        $this->setIfExists('is_proxy', $data ?? [], null);
        $this->setIfExists('proxy_type', $data ?? [], null);
        $this->setIfExists('proxy_provider', $data ?? [], null);
        $this->setIfExists('is_anonymous', $data ?? [], null);
        $this->setIfExists('is_known_attacker', $data ?? [], null);
        $this->setIfExists('is_spam', $data ?? [], null);
        $this->setIfExists('is_bot', $data ?? [], null);
        $this->setIfExists('is_cloud_provider', $data ?? [], null);
        $this->setIfExists('cloud_provider', $data ?? [], null);
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
     * Gets threat_score
     *
     * @return int|null
     */
    public function getThreatScore()
    {
        return $this->container['threat_score'];
    }

    /**
     * Sets threat_score
     *
     * @param int|null $threat_score threat_score
     *
     * @return self
     */
    public function setThreatScore($threat_score)
    {
        if (is_null($threat_score)) {
            throw new \InvalidArgumentException('non-nullable threat_score cannot be null');
        }
        $this->container['threat_score'] = $threat_score;

        return $this;
    }

    /**
     * Gets is_tor
     *
     * @return bool|null
     */
    public function getIsTor()
    {
        return $this->container['is_tor'];
    }

    /**
     * Sets is_tor
     *
     * @param bool|null $is_tor is_tor
     *
     * @return self
     */
    public function setIsTor($is_tor)
    {
        if (is_null($is_tor)) {
            throw new \InvalidArgumentException('non-nullable is_tor cannot be null');
        }
        $this->container['is_tor'] = $is_tor;

        return $this;
    }

    /**
     * Gets is_proxy
     *
     * @return bool|null
     */
    public function getIsProxy()
    {
        return $this->container['is_proxy'];
    }

    /**
     * Sets is_proxy
     *
     * @param bool|null $is_proxy is_proxy
     *
     * @return self
     */
    public function setIsProxy($is_proxy)
    {
        if (is_null($is_proxy)) {
            throw new \InvalidArgumentException('non-nullable is_proxy cannot be null');
        }
        $this->container['is_proxy'] = $is_proxy;

        return $this;
    }

    /**
     * Gets proxy_type
     *
     * @return string|null
     */
    public function getProxyType()
    {
        return $this->container['proxy_type'];
    }

    /**
     * Sets proxy_type
     *
     * @param string|null $proxy_type proxy_type
     *
     * @return self
     */
    public function setProxyType($proxy_type)
    {
        if (is_null($proxy_type)) {
            throw new \InvalidArgumentException('non-nullable proxy_type cannot be null');
        }
        $this->container['proxy_type'] = $proxy_type;

        return $this;
    }

    /**
     * Gets proxy_provider
     *
     * @return string|null
     */
    public function getProxyProvider()
    {
        return $this->container['proxy_provider'];
    }

    /**
     * Sets proxy_provider
     *
     * @param string|null $proxy_provider proxy_provider
     *
     * @return self
     */
    public function setProxyProvider($proxy_provider)
    {
        if (is_null($proxy_provider)) {
            throw new \InvalidArgumentException('non-nullable proxy_provider cannot be null');
        }
        $this->container['proxy_provider'] = $proxy_provider;

        return $this;
    }

    /**
     * Gets is_anonymous
     *
     * @return bool|null
     */
    public function getIsAnonymous()
    {
        return $this->container['is_anonymous'];
    }

    /**
     * Sets is_anonymous
     *
     * @param bool|null $is_anonymous is_anonymous
     *
     * @return self
     */
    public function setIsAnonymous($is_anonymous)
    {
        if (is_null($is_anonymous)) {
            throw new \InvalidArgumentException('non-nullable is_anonymous cannot be null');
        }
        $this->container['is_anonymous'] = $is_anonymous;

        return $this;
    }

    /**
     * Gets is_known_attacker
     *
     * @return bool|null
     */
    public function getIsKnownAttacker()
    {
        return $this->container['is_known_attacker'];
    }

    /**
     * Sets is_known_attacker
     *
     * @param bool|null $is_known_attacker is_known_attacker
     *
     * @return self
     */
    public function setIsKnownAttacker($is_known_attacker)
    {
        if (is_null($is_known_attacker)) {
            throw new \InvalidArgumentException('non-nullable is_known_attacker cannot be null');
        }
        $this->container['is_known_attacker'] = $is_known_attacker;

        return $this;
    }

    /**
     * Gets is_spam
     *
     * @return bool|null
     */
    public function getIsSpam()
    {
        return $this->container['is_spam'];
    }

    /**
     * Sets is_spam
     *
     * @param bool|null $is_spam is_spam
     *
     * @return self
     */
    public function setIsSpam($is_spam)
    {
        if (is_null($is_spam)) {
            throw new \InvalidArgumentException('non-nullable is_spam cannot be null');
        }
        $this->container['is_spam'] = $is_spam;

        return $this;
    }

    /**
     * Gets is_bot
     *
     * @return bool|null
     */
    public function getIsBot()
    {
        return $this->container['is_bot'];
    }

    /**
     * Sets is_bot
     *
     * @param bool|null $is_bot is_bot
     *
     * @return self
     */
    public function setIsBot($is_bot)
    {
        if (is_null($is_bot)) {
            throw new \InvalidArgumentException('non-nullable is_bot cannot be null');
        }
        $this->container['is_bot'] = $is_bot;

        return $this;
    }

    /**
     * Gets is_cloud_provider
     *
     * @return bool|null
     */
    public function getIsCloudProvider()
    {
        return $this->container['is_cloud_provider'];
    }

    /**
     * Sets is_cloud_provider
     *
     * @param bool|null $is_cloud_provider is_cloud_provider
     *
     * @return self
     */
    public function setIsCloudProvider($is_cloud_provider)
    {
        if (is_null($is_cloud_provider)) {
            throw new \InvalidArgumentException('non-nullable is_cloud_provider cannot be null');
        }
        $this->container['is_cloud_provider'] = $is_cloud_provider;

        return $this;
    }

    /**
     * Gets cloud_provider
     *
     * @return string|null
     */
    public function getCloudProvider()
    {
        return $this->container['cloud_provider'];
    }

    /**
     * Sets cloud_provider
     *
     * @param string|null $cloud_provider cloud_provider
     *
     * @return self
     */
    public function setCloudProvider($cloud_provider)
    {
        if (is_null($cloud_provider)) {
            throw new \InvalidArgumentException('non-nullable cloud_provider cannot be null');
        }
        $this->container['cloud_provider'] = $cloud_provider;

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


