<?php
/**
 * ASNDetails
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
 * ASNDetails Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 * @implements \ArrayAccess<string, mixed>
 */
class ASNDetails implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $ipgeoapiModelName = 'ASNDetails';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $ipgeoapiTypes = [
        'as_number' => 'string',
        'organization' => 'string',
        'country' => 'string',
        'asn_name' => 'string',
        'type' => 'string',
        'domain' => 'string',
        'date_allocated' => 'string',
        'allocation_status' => 'string',
        'num_of_ipv4_routes' => 'int',
        'num_of_ipv6_routes' => 'int',
        'rir' => 'string',
        'routes' => 'string[]',
        'upstreams' => '\Ipgeolocation\Sdk\\Model\ASNConnection[]',
        'downstreams' => '\Ipgeolocation\Sdk\\Model\ASNConnection[]',
        'peers' => '\Ipgeolocation\Sdk\\Model\ASNConnection[]',
        'whois_response' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $ipgeoapiFormats = [
        'as_number' => null,
        'organization' => null,
        'country' => null,
        'asn_name' => null,
        'type' => null,
        'domain' => 'uri',
        'date_allocated' => null,
        'allocation_status' => null,
        'num_of_ipv4_routes' => null,
        'num_of_ipv6_routes' => null,
        'rir' => null,
        'routes' => null,
        'upstreams' => null,
        'downstreams' => null,
        'peers' => null,
        'whois_response' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $ipgeoapiNullables = [
        'as_number' => false,
        'organization' => false,
        'country' => false,
        'asn_name' => false,
        'type' => false,
        'domain' => false,
        'date_allocated' => false,
        'allocation_status' => false,
        'num_of_ipv4_routes' => false,
        'num_of_ipv6_routes' => false,
        'rir' => false,
        'routes' => false,
        'upstreams' => false,
        'downstreams' => false,
        'peers' => false,
        'whois_response' => false
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
        'as_number' => 'as_number',
        'organization' => 'organization',
        'country' => 'country',
        'asn_name' => 'asn_name',
        'type' => 'type',
        'domain' => 'domain',
        'date_allocated' => 'date_allocated',
        'allocation_status' => 'allocation_status',
        'num_of_ipv4_routes' => 'num_of_ipv4_routes',
        'num_of_ipv6_routes' => 'num_of_ipv6_routes',
        'rir' => 'rir',
        'routes' => 'routes',
        'upstreams' => 'upstreams',
        'downstreams' => 'downstreams',
        'peers' => 'peers',
        'whois_response' => 'whois_response'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'as_number' => 'setAsNumber',
        'organization' => 'setOrganization',
        'country' => 'setCountry',
        'asn_name' => 'setAsnName',
        'type' => 'setType',
        'domain' => 'setDomain',
        'date_allocated' => 'setDateAllocated',
        'allocation_status' => 'setAllocationStatus',
        'num_of_ipv4_routes' => 'setNumOfIpv4Routes',
        'num_of_ipv6_routes' => 'setNumOfIpv6Routes',
        'rir' => 'setRir',
        'routes' => 'setRoutes',
        'upstreams' => 'setUpstreams',
        'downstreams' => 'setDownstreams',
        'peers' => 'setPeers',
        'whois_response' => 'setWhoisResponse'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'as_number' => 'getAsNumber',
        'organization' => 'getOrganization',
        'country' => 'getCountry',
        'asn_name' => 'getAsnName',
        'type' => 'getType',
        'domain' => 'getDomain',
        'date_allocated' => 'getDateAllocated',
        'allocation_status' => 'getAllocationStatus',
        'num_of_ipv4_routes' => 'getNumOfIpv4Routes',
        'num_of_ipv6_routes' => 'getNumOfIpv6Routes',
        'rir' => 'getRir',
        'routes' => 'getRoutes',
        'upstreams' => 'getUpstreams',
        'downstreams' => 'getDownstreams',
        'peers' => 'getPeers',
        'whois_response' => 'getWhoisResponse'
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
        $this->setIfExists('as_number', $data ?? [], null);
        $this->setIfExists('organization', $data ?? [], null);
        $this->setIfExists('country', $data ?? [], null);
        $this->setIfExists('asn_name', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('domain', $data ?? [], null);
        $this->setIfExists('date_allocated', $data ?? [], null);
        $this->setIfExists('allocation_status', $data ?? [], null);
        $this->setIfExists('num_of_ipv4_routes', $data ?? [], null);
        $this->setIfExists('num_of_ipv6_routes', $data ?? [], null);
        $this->setIfExists('rir', $data ?? [], null);
        $this->setIfExists('routes', $data ?? [], null);
        $this->setIfExists('upstreams', $data ?? [], null);
        $this->setIfExists('downstreams', $data ?? [], null);
        $this->setIfExists('peers', $data ?? [], null);
        $this->setIfExists('whois_response', $data ?? [], null);
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
     * Gets as_number
     *
     * @return string|null
     */
    public function getAsNumber()
    {
        return $this->container['as_number'];
    }

    /**
     * Sets as_number
     *
     * @param string|null $as_number as_number
     *
     * @return self
     */
    public function setAsNumber($as_number)
    {
        if (is_null($as_number)) {
            throw new \InvalidArgumentException('non-nullable as_number cannot be null');
        }
        $this->container['as_number'] = $as_number;

        return $this;
    }

    /**
     * Gets organization
     *
     * @return string|null
     */
    public function getOrganization()
    {
        return $this->container['organization'];
    }

    /**
     * Sets organization
     *
     * @param string|null $organization organization
     *
     * @return self
     */
    public function setOrganization($organization)
    {
        if (is_null($organization)) {
            throw new \InvalidArgumentException('non-nullable organization cannot be null');
        }
        $this->container['organization'] = $organization;

        return $this;
    }

    /**
     * Gets country
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->container['country'];
    }

    /**
     * Sets country
     *
     * @param string|null $country country
     *
     * @return self
     */
    public function setCountry($country)
    {
        if (is_null($country)) {
            throw new \InvalidArgumentException('non-nullable country cannot be null');
        }
        $this->container['country'] = $country;

        return $this;
    }

    /**
     * Gets asn_name
     *
     * @return string|null
     */
    public function getAsnName()
    {
        return $this->container['asn_name'];
    }

    /**
     * Sets asn_name
     *
     * @param string|null $asn_name asn_name
     *
     * @return self
     */
    public function setAsnName($asn_name)
    {
        if (is_null($asn_name)) {
            throw new \InvalidArgumentException('non-nullable asn_name cannot be null');
        }
        $this->container['asn_name'] = $asn_name;

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
     * Gets domain
     *
     * @return string|null
     */
    public function getDomain()
    {
        return $this->container['domain'];
    }

    /**
     * Sets domain
     *
     * @param string|null $domain domain
     *
     * @return self
     */
    public function setDomain($domain)
    {
        if (is_null($domain)) {
            throw new \InvalidArgumentException('non-nullable domain cannot be null');
        }
        $this->container['domain'] = $domain;

        return $this;
    }

    /**
     * Gets date_allocated
     *
     * @return \string|null
     */
    public function getDateAllocated()
    {
        return $this->container['date_allocated'];
    }

    /**
     * Sets date_allocated
     *
     * @param string|null $date_allocated date_allocated
     *
     * @return self
     */
    public function setDateAllocated($date_allocated)
    {
        if (is_null($date_allocated)) {
            throw new \InvalidArgumentException('non-nullable date_allocated cannot be null');
        }
        $this->container['date_allocated'] = $date_allocated;

        return $this;
    }

    /**
     * Gets allocation_status
     *
     * @return string|null
     */
    public function getAllocationStatus()
    {
        return $this->container['allocation_status'];
    }

    /**
     * Sets allocation_status
     *
     * @param string|null $allocation_status allocation_status
     *
     * @return self
     */
    public function setAllocationStatus($allocation_status)
    {
        if (is_null($allocation_status)) {
            throw new \InvalidArgumentException('non-nullable allocation_status cannot be null');
        }
        $this->container['allocation_status'] = $allocation_status;

        return $this;
    }

    /**
     * Gets num_of_ipv4_routes
     *
     * @return int|null
     */
    public function getNumOfIpv4Routes()
    {
        return $this->container['num_of_ipv4_routes'];
    }

    /**
     * Sets num_of_ipv4_routes
     *
     * @param int|null $num_of_ipv4_routes num_of_ipv4_routes
     *
     * @return self
     */
    public function setNumOfIpv4Routes($num_of_ipv4_routes)
    {
        if (is_null($num_of_ipv4_routes)) {
            throw new \InvalidArgumentException('non-nullable num_of_ipv4_routes cannot be null');
        }
        $this->container['num_of_ipv4_routes'] = $num_of_ipv4_routes;

        return $this;
    }

    /**
     * Gets num_of_ipv6_routes
     *
     * @return int|null
     */
    public function getNumOfIpv6Routes()
    {
        return $this->container['num_of_ipv6_routes'];
    }

    /**
     * Sets num_of_ipv6_routes
     *
     * @param int|null $num_of_ipv6_routes num_of_ipv6_routes
     *
     * @return self
     */
    public function setNumOfIpv6Routes($num_of_ipv6_routes)
    {
        if (is_null($num_of_ipv6_routes)) {
            throw new \InvalidArgumentException('non-nullable num_of_ipv6_routes cannot be null');
        }
        $this->container['num_of_ipv6_routes'] = $num_of_ipv6_routes;

        return $this;
    }

    /**
     * Gets rir
     *
     * @return string|null
     */
    public function getRir()
    {
        return $this->container['rir'];
    }

    /**
     * Sets rir
     *
     * @param string|null $rir rir
     *
     * @return self
     */
    public function setRir($rir)
    {
        if (is_null($rir)) {
            throw new \InvalidArgumentException('non-nullable rir cannot be null');
        }
        $this->container['rir'] = $rir;

        return $this;
    }

    /**
     * Gets routes
     *
     * @return string[]|null
     */
    public function getRoutes()
    {
        return $this->container['routes'];
    }

    /**
     * Sets routes
     *
     * @param string[]|null $routes It will only be included in the response, if you set include=routes in the request
     *
     * @return self
     */
    public function setRoutes($routes)
    {
        if (is_null($routes)) {
            throw new \InvalidArgumentException('non-nullable routes cannot be null');
        }
        $this->container['routes'] = $routes;

        return $this;
    }

    /**
     * Gets upstreams
     *
     * @return \Ipgeolocation\Sdk\\Model\ASNConnection[]|null
     */
    public function getUpstreams()
    {
        return $this->container['upstreams'];
    }

    /**
     * Sets upstreams
     *
     * @param \Ipgeolocation\Sdk\\Model\ASNConnection[]|null $upstreams It will only be included in the response, if you set include=upstreams in the request
     *
     * @return self
     */
    public function setUpstreams($upstreams)
    {
        if (is_null($upstreams)) {
            throw new \InvalidArgumentException('non-nullable upstreams cannot be null');
        }
        $this->container['upstreams'] = $upstreams;

        return $this;
    }

    /**
     * Gets downstreams
     *
     * @return \Ipgeolocation\Sdk\\Model\ASNConnection[]|null
     */
    public function getDownstreams()
    {
        return $this->container['downstreams'];
    }

    /**
     * Sets downstreams
     *
     * @param \Ipgeolocation\Sdk\\Model\ASNConnection[]|null $downstreams It will only be included in the response, if you set include=downstreams in the request
     *
     * @return self
     */
    public function setDownstreams($downstreams)
    {
        if (is_null($downstreams)) {
            throw new \InvalidArgumentException('non-nullable downstreams cannot be null');
        }
        $this->container['downstreams'] = $downstreams;

        return $this;
    }

    /**
     * Gets peers
     *
     * @return \Ipgeolocation\Sdk\\Model\ASNConnection[]|null
     */
    public function getPeers()
    {
        return $this->container['peers'];
    }

    /**
     * Sets peers
     *
     * @param \Ipgeolocation\Sdk\\Model\ASNConnection[]|null $peers It will only be included in the response, if you set include=peers in the request
     *
     * @return self
     */
    public function setPeers($peers)
    {
        if (is_null($peers)) {
            throw new \InvalidArgumentException('non-nullable peers cannot be null');
        }
        $this->container['peers'] = $peers;

        return $this;
    }

    /**
     * Gets whois_response
     *
     * @return string|null
     */
    public function getWhoisResponse()
    {
        return $this->container['whois_response'];
    }

    /**
     * Sets whois_response
     *
     * @param string|null $whois_response It will only be included in the response, if you set include=whois_response in the request
     *
     * @return self
     */
    public function setWhoisResponse($whois_response)
    {
        if (is_null($whois_response)) {
            throw new \InvalidArgumentException('non-nullable whois_response cannot be null');
        }
        $this->container['whois_response'] = $whois_response;

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


