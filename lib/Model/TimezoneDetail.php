<?php
/**
 * TimezoneDetail
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
 * TimezoneDetail Class Doc Comment
 *
 * @category Class
 * @package  Ipgeolocation\Sdk
 * @author   Ipgeolocation team
 * @implements \ArrayAccess<string, mixed>
 */
class TimezoneDetail implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $ipgeoapiModelName = 'TimezoneDetail';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $ipgeoapiTypes = [
        'name' => 'string',
        'offset' => 'int',
        'offset_with_dst' => 'int',
        'date' => '\DateTime',
        'date_time' => 'string',
        'date_time_txt' => 'string',
        'date_time_wti' => 'string',
        'date_time_ymd' => '\DateTime',
        'date_time_unix' => 'float',
        'time_24' => 'string',
        'time_12' => 'string',
        'week' => 'int',
        'month' => 'int',
        'year' => 'int',
        'year_abbr' => 'string',
        'is_dst' => 'bool',
        'dst_savings' => 'int',
        'dst_exists' => 'bool',
        'dst_start' => '\Ipgeolocation\Sdk\\Model\TimezoneDetailDstStart',
        'dst_end' => '\Ipgeolocation\Sdk\\Model\TimezoneDetailDstEnd'
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
        'date' => 'date',
        'date_time' => null,
        'date_time_txt' => null,
        'date_time_wti' => null,
        'date_time_ymd' => 'date-time',
        'date_time_unix' => 'double',
        'time_24' => null,
        'time_12' => null,
        'week' => null,
        'month' => null,
        'year' => null,
        'year_abbr' => null,
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
        'date' => false,
        'date_time' => false,
        'date_time_txt' => false,
        'date_time_wti' => false,
        'date_time_ymd' => false,
        'date_time_unix' => false,
        'time_24' => false,
        'time_12' => false,
        'week' => false,
        'month' => false,
        'year' => false,
        'year_abbr' => false,
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
        'date' => 'date',
        'date_time' => 'date_time',
        'date_time_txt' => 'date_time_txt',
        'date_time_wti' => 'date_time_wti',
        'date_time_ymd' => 'date_time_ymd',
        'date_time_unix' => 'date_time_unix',
        'time_24' => 'time_24',
        'time_12' => 'time_12',
        'week' => 'week',
        'month' => 'month',
        'year' => 'year',
        'year_abbr' => 'year_abbr',
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
        'date' => 'setDate',
        'date_time' => 'setDateTime',
        'date_time_txt' => 'setDateTimeTxt',
        'date_time_wti' => 'setDateTimeWti',
        'date_time_ymd' => 'setDateTimeYmd',
        'date_time_unix' => 'setDateTimeUnix',
        'time_24' => 'setTime24',
        'time_12' => 'setTime12',
        'week' => 'setWeek',
        'month' => 'setMonth',
        'year' => 'setYear',
        'year_abbr' => 'setYearAbbr',
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
        'date' => 'getDate',
        'date_time' => 'getDateTime',
        'date_time_txt' => 'getDateTimeTxt',
        'date_time_wti' => 'getDateTimeWti',
        'date_time_ymd' => 'getDateTimeYmd',
        'date_time_unix' => 'getDateTimeUnix',
        'time_24' => 'getTime24',
        'time_12' => 'getTime12',
        'week' => 'getWeek',
        'month' => 'getMonth',
        'year' => 'getYear',
        'year_abbr' => 'getYearAbbr',
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
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('date_time', $data ?? [], null);
        $this->setIfExists('date_time_txt', $data ?? [], null);
        $this->setIfExists('date_time_wti', $data ?? [], null);
        $this->setIfExists('date_time_ymd', $data ?? [], null);
        $this->setIfExists('date_time_unix', $data ?? [], null);
        $this->setIfExists('time_24', $data ?? [], null);
        $this->setIfExists('time_12', $data ?? [], null);
        $this->setIfExists('week', $data ?? [], null);
        $this->setIfExists('month', $data ?? [], null);
        $this->setIfExists('year', $data ?? [], null);
        $this->setIfExists('year_abbr', $data ?? [], null);
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
     * Gets date_time
     *
     * @return string|null
     */
    public function getDateTime()
    {
        return $this->container['date_time'];
    }

    /**
     * Sets date_time
     *
     * @param string|null $date_time date_time
     *
     * @return self
     */
    public function setDateTime($date_time)
    {
        if (is_null($date_time)) {
            throw new \InvalidArgumentException('non-nullable date_time cannot be null');
        }
        $this->container['date_time'] = $date_time;

        return $this;
    }

    /**
     * Gets date_time_txt
     *
     * @return string|null
     */
    public function getDateTimeTxt()
    {
        return $this->container['date_time_txt'];
    }

    /**
     * Sets date_time_txt
     *
     * @param string|null $date_time_txt date_time_txt
     *
     * @return self
     */
    public function setDateTimeTxt($date_time_txt)
    {
        if (is_null($date_time_txt)) {
            throw new \InvalidArgumentException('non-nullable date_time_txt cannot be null');
        }
        $this->container['date_time_txt'] = $date_time_txt;

        return $this;
    }

    /**
     * Gets date_time_wti
     *
     * @return string|null
     */
    public function getDateTimeWti()
    {
        return $this->container['date_time_wti'];
    }

    /**
     * Sets date_time_wti
     *
     * @param string|null $date_time_wti date_time_wti
     *
     * @return self
     */
    public function setDateTimeWti($date_time_wti)
    {
        if (is_null($date_time_wti)) {
            throw new \InvalidArgumentException('non-nullable date_time_wti cannot be null');
        }
        $this->container['date_time_wti'] = $date_time_wti;

        return $this;
    }

    /**
     * Gets date_time_ymd
     *
     * @return \DateTime|null
     */
    public function getDateTimeYmd()
    {
        return $this->container['date_time_ymd'];
    }

    /**
     * Sets date_time_ymd
     *
     * @param \DateTime|null $date_time_ymd date_time_ymd
     *
     * @return self
     */
    public function setDateTimeYmd($date_time_ymd)
    {
        if (is_null($date_time_ymd)) {
            throw new \InvalidArgumentException('non-nullable date_time_ymd cannot be null');
        }
        $this->container['date_time_ymd'] = $date_time_ymd;

        return $this;
    }

    /**
     * Gets date_time_unix
     *
     * @return float|null
     */
    public function getDateTimeUnix()
    {
        return $this->container['date_time_unix'];
    }

    /**
     * Sets date_time_unix
     *
     * @param float|null $date_time_unix date_time_unix
     *
     * @return self
     */
    public function setDateTimeUnix($date_time_unix)
    {
        if (is_null($date_time_unix)) {
            throw new \InvalidArgumentException('non-nullable date_time_unix cannot be null');
        }
        $this->container['date_time_unix'] = $date_time_unix;

        return $this;
    }

    /**
     * Gets time_24
     *
     * @return string|null
     */
    public function getTime24()
    {
        return $this->container['time_24'];
    }

    /**
     * Sets time_24
     *
     * @param string|null $time_24 time_24
     *
     * @return self
     */
    public function setTime24($time_24)
    {
        if (is_null($time_24)) {
            throw new \InvalidArgumentException('non-nullable time_24 cannot be null');
        }
        $this->container['time_24'] = $time_24;

        return $this;
    }

    /**
     * Gets time_12
     *
     * @return string|null
     */
    public function getTime12()
    {
        return $this->container['time_12'];
    }

    /**
     * Sets time_12
     *
     * @param string|null $time_12 time_12
     *
     * @return self
     */
    public function setTime12($time_12)
    {
        if (is_null($time_12)) {
            throw new \InvalidArgumentException('non-nullable time_12 cannot be null');
        }
        $this->container['time_12'] = $time_12;

        return $this;
    }

    /**
     * Gets week
     *
     * @return int|null
     */
    public function getWeek()
    {
        return $this->container['week'];
    }

    /**
     * Sets week
     *
     * @param int|null $week week
     *
     * @return self
     */
    public function setWeek($week)
    {
        if (is_null($week)) {
            throw new \InvalidArgumentException('non-nullable week cannot be null');
        }
        $this->container['week'] = $week;

        return $this;
    }

    /**
     * Gets month
     *
     * @return int|null
     */
    public function getMonth()
    {
        return $this->container['month'];
    }

    /**
     * Sets month
     *
     * @param int|null $month month
     *
     * @return self
     */
    public function setMonth($month)
    {
        if (is_null($month)) {
            throw new \InvalidArgumentException('non-nullable month cannot be null');
        }
        $this->container['month'] = $month;

        return $this;
    }

    /**
     * Gets year
     *
     * @return int|null
     */
    public function getYear()
    {
        return $this->container['year'];
    }

    /**
     * Sets year
     *
     * @param int|null $year year
     *
     * @return self
     */
    public function setYear($year)
    {
        if (is_null($year)) {
            throw new \InvalidArgumentException('non-nullable year cannot be null');
        }
        $this->container['year'] = $year;

        return $this;
    }

    /**
     * Gets year_abbr
     *
     * @return string|null
     */
    public function getYearAbbr()
    {
        return $this->container['year_abbr'];
    }

    /**
     * Sets year_abbr
     *
     * @param string|null $year_abbr year_abbr
     *
     * @return self
     */
    public function setYearAbbr($year_abbr)
    {
        if (is_null($year_abbr)) {
            throw new \InvalidArgumentException('non-nullable year_abbr cannot be null');
        }
        $this->container['year_abbr'] = $year_abbr;

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
     * @return \Ipgeolocation\Sdk\\Model\TimezoneDetailDstStart|null
     */
    public function getDstStart()
    {
        return $this->container['dst_start'];
    }

    /**
     * Sets dst_start
     *
     * @param \Ipgeolocation\Sdk\\Model\TimezoneDetailDstStart|null $dst_start dst_start
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
     * @return \Ipgeolocation\Sdk\\Model\TimezoneDetailDstEnd|null
     */
    public function getDstEnd()
    {
        return $this->container['dst_end'];
    }

    /**
     * Sets dst_end
     *
     * @param \Ipgeolocation\Sdk\\Model\TimezoneDetailDstEnd|null $dst_end dst_end
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


