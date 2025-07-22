<?php
/**
 * AstronomyEvening
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
 * AstronomyEvening Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 * @implements \ArrayAccess<string, mixed>
 */
class AstronomyEvening implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $ipgeoapiModelName = 'Astronomy_evening';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $ipgeoapiTypes = [
        'golden_hour_begin' => 'string',
        'golden_hour_end' => 'string',
        'blue_hour_begin' => 'string',
        'blue_hour_end' => 'string',
        'civil_twilight_begin' => 'string',
        'civil_twilight_end' => 'string',
        'nautical_twilight_begin' => 'string',
        'nautical_twilight_end' => 'string',
        'astronomical_twilight_begin' => 'string',
        'astronomical_twilight_end' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $ipgeoapiFormats = [
        'golden_hour_begin' => null,
        'golden_hour_end' => null,
        'blue_hour_begin' => null,
        'blue_hour_end' => null,
        'civil_twilight_begin' => null,
        'civil_twilight_end' => null,
        'nautical_twilight_begin' => null,
        'nautical_twilight_end' => null,
        'astronomical_twilight_begin' => null,
        'astronomical_twilight_end' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $ipgeoapiNullables = [
        'golden_hour_begin' => false,
        'golden_hour_end' => false,
        'blue_hour_begin' => false,
        'blue_hour_end' => false,
        'civil_twilight_begin' => false,
        'civil_twilight_end' => false,
        'nautical_twilight_begin' => false,
        'nautical_twilight_end' => false,
        'astronomical_twilight_begin' => false,
        'astronomical_twilight_end' => false
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
        'golden_hour_begin' => 'golden_hour_begin',
        'golden_hour_end' => 'golden_hour_end',
        'blue_hour_begin' => 'blue_hour_begin',
        'blue_hour_end' => 'blue_hour_end',
        'civil_twilight_begin' => 'civil_twilight_begin',
        'civil_twilight_end' => 'civil_twilight_end',
        'nautical_twilight_begin' => 'nautical_twilight_begin',
        'nautical_twilight_end' => 'nautical_twilight_end',
        'astronomical_twilight_begin' => 'astronomical_twilight_begin',
        'astronomical_twilight_end' => 'astronomical_twilight_end'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'golden_hour_begin' => 'setGoldenHourBegin',
        'golden_hour_end' => 'setGoldenHourEnd',
        'blue_hour_begin' => 'setBlueHourBegin',
        'blue_hour_end' => 'setBlueHourEnd',
        'civil_twilight_begin' => 'setCivilTwilightBegin',
        'civil_twilight_end' => 'setCivilTwilightEnd',
        'nautical_twilight_begin' => 'setNauticalTwilightBegin',
        'nautical_twilight_end' => 'setNauticalTwilightEnd',
        'astronomical_twilight_begin' => 'setAstronomicalTwilightBegin',
        'astronomical_twilight_end' => 'setAstronomicalTwilightEnd'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'golden_hour_begin' => 'getGoldenHourBegin',
        'golden_hour_end' => 'getGoldenHourEnd',
        'blue_hour_begin' => 'getBlueHourBegin',
        'blue_hour_end' => 'getBlueHourEnd',
        'civil_twilight_begin' => 'getCivilTwilightBegin',
        'civil_twilight_end' => 'getCivilTwilightEnd',
        'nautical_twilight_begin' => 'getNauticalTwilightBegin',
        'nautical_twilight_end' => 'getNauticalTwilightEnd',
        'astronomical_twilight_begin' => 'getAstronomicalTwilightBegin',
        'astronomical_twilight_end' => 'getAstronomicalTwilightEnd'
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
        $this->setIfExists('golden_hour_begin', $data ?? [], null);
        $this->setIfExists('golden_hour_end', $data ?? [], null);
        $this->setIfExists('blue_hour_begin', $data ?? [], null);
        $this->setIfExists('blue_hour_end', $data ?? [], null);
        $this->setIfExists('civil_twilight_begin', $data ?? [], null);
        $this->setIfExists('civil_twilight_end', $data ?? [], null);
        $this->setIfExists('nautical_twilight_begin', $data ?? [], null);
        $this->setIfExists('nautical_twilight_end', $data ?? [], null);
        $this->setIfExists('astronomical_twilight_begin', $data ?? [], null);
        $this->setIfExists('astronomical_twilight_end', $data ?? [], null);
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
     * Gets golden_hour_begin
     *
     * @return string|null
     */
    public function getGoldenHourBegin()
    {
        return $this->container['golden_hour_begin'];
    }

    /**
     * Sets golden_hour_begin
     *
     * @param string|null $golden_hour_begin golden_hour_begin
     *
     * @return self
     */
    public function setGoldenHourBegin($golden_hour_begin)
    {
        if (is_null($golden_hour_begin)) {
            throw new \InvalidArgumentException('non-nullable golden_hour_begin cannot be null');
        }
        $this->container['golden_hour_begin'] = $golden_hour_begin;

        return $this;
    }

    /**
     * Gets golden_hour_end
     *
     * @return string|null
     */
    public function getGoldenHourEnd()
    {
        return $this->container['golden_hour_end'];
    }

    /**
     * Sets golden_hour_end
     *
     * @param string|null $golden_hour_end golden_hour_end
     *
     * @return self
     */
    public function setGoldenHourEnd($golden_hour_end)
    {
        if (is_null($golden_hour_end)) {
            throw new \InvalidArgumentException('non-nullable golden_hour_end cannot be null');
        }
        $this->container['golden_hour_end'] = $golden_hour_end;

        return $this;
    }

    /**
     * Gets blue_hour_begin
     *
     * @return string|null
     */
    public function getBlueHourBegin()
    {
        return $this->container['blue_hour_begin'];
    }

    /**
     * Sets blue_hour_begin
     *
     * @param string|null $blue_hour_begin blue_hour_begin
     *
     * @return self
     */
    public function setBlueHourBegin($blue_hour_begin)
    {
        if (is_null($blue_hour_begin)) {
            throw new \InvalidArgumentException('non-nullable blue_hour_begin cannot be null');
        }
        $this->container['blue_hour_begin'] = $blue_hour_begin;

        return $this;
    }

    /**
     * Gets blue_hour_end
     *
     * @return string|null
     */
    public function getBlueHourEnd()
    {
        return $this->container['blue_hour_end'];
    }

    /**
     * Sets blue_hour_end
     *
     * @param string|null $blue_hour_end blue_hour_end
     *
     * @return self
     */
    public function setBlueHourEnd($blue_hour_end)
    {
        if (is_null($blue_hour_end)) {
            throw new \InvalidArgumentException('non-nullable blue_hour_end cannot be null');
        }
        $this->container['blue_hour_end'] = $blue_hour_end;

        return $this;
    }

    /**
     * Gets civil_twilight_begin
     *
     * @return string|null
     */
    public function getCivilTwilightBegin()
    {
        return $this->container['civil_twilight_begin'];
    }

    /**
     * Sets civil_twilight_begin
     *
     * @param string|null $civil_twilight_begin civil_twilight_begin
     *
     * @return self
     */
    public function setCivilTwilightBegin($civil_twilight_begin)
    {
        if (is_null($civil_twilight_begin)) {
            throw new \InvalidArgumentException('non-nullable civil_twilight_begin cannot be null');
        }
        $this->container['civil_twilight_begin'] = $civil_twilight_begin;

        return $this;
    }

    /**
     * Gets civil_twilight_end
     *
     * @return string|null
     */
    public function getCivilTwilightEnd()
    {
        return $this->container['civil_twilight_end'];
    }

    /**
     * Sets civil_twilight_end
     *
     * @param string|null $civil_twilight_end civil_twilight_end
     *
     * @return self
     */
    public function setCivilTwilightEnd($civil_twilight_end)
    {
        if (is_null($civil_twilight_end)) {
            throw new \InvalidArgumentException('non-nullable civil_twilight_end cannot be null');
        }
        $this->container['civil_twilight_end'] = $civil_twilight_end;

        return $this;
    }

    /**
     * Gets nautical_twilight_begin
     *
     * @return string|null
     */
    public function getNauticalTwilightBegin()
    {
        return $this->container['nautical_twilight_begin'];
    }

    /**
     * Sets nautical_twilight_begin
     *
     * @param string|null $nautical_twilight_begin nautical_twilight_begin
     *
     * @return self
     */
    public function setNauticalTwilightBegin($nautical_twilight_begin)
    {
        if (is_null($nautical_twilight_begin)) {
            throw new \InvalidArgumentException('non-nullable nautical_twilight_begin cannot be null');
        }
        $this->container['nautical_twilight_begin'] = $nautical_twilight_begin;

        return $this;
    }

    /**
     * Gets nautical_twilight_end
     *
     * @return string|null
     */
    public function getNauticalTwilightEnd()
    {
        return $this->container['nautical_twilight_end'];
    }

    /**
     * Sets nautical_twilight_end
     *
     * @param string|null $nautical_twilight_end nautical_twilight_end
     *
     * @return self
     */
    public function setNauticalTwilightEnd($nautical_twilight_end)
    {
        if (is_null($nautical_twilight_end)) {
            throw new \InvalidArgumentException('non-nullable nautical_twilight_end cannot be null');
        }
        $this->container['nautical_twilight_end'] = $nautical_twilight_end;

        return $this;
    }

    /**
     * Gets astronomical_twilight_begin
     *
     * @return string|null
     */
    public function getAstronomicalTwilightBegin()
    {
        return $this->container['astronomical_twilight_begin'];
    }

    /**
     * Sets astronomical_twilight_begin
     *
     * @param string|null $astronomical_twilight_begin astronomical_twilight_begin
     *
     * @return self
     */
    public function setAstronomicalTwilightBegin($astronomical_twilight_begin)
    {
        if (is_null($astronomical_twilight_begin)) {
            throw new \InvalidArgumentException('non-nullable astronomical_twilight_begin cannot be null');
        }
        $this->container['astronomical_twilight_begin'] = $astronomical_twilight_begin;

        return $this;
    }

    /**
     * Gets astronomical_twilight_end
     *
     * @return string|null
     */
    public function getAstronomicalTwilightEnd()
    {
        return $this->container['astronomical_twilight_end'];
    }

    /**
     * Sets astronomical_twilight_end
     *
     * @param string|null $astronomical_twilight_end astronomical_twilight_end
     *
     * @return self
     */
    public function setAstronomicalTwilightEnd($astronomical_twilight_end)
    {
        if (is_null($astronomical_twilight_end)) {
            throw new \InvalidArgumentException('non-nullable astronomical_twilight_end cannot be null');
        }
        $this->container['astronomical_twilight_end'] = $astronomical_twilight_end;

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


