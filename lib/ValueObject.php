<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

use BackedEnum;
use JsonSerializable;

abstract class ValueObject implements JsonSerializable
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $keepNulls = false): array
    {
        /** @var array<string, mixed> $data */
        $data = self::normalizeValue(get_object_vars($this), $keepNulls);
        return $data;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray(false);
    }

    protected static function normalizeValue(mixed $value, bool $keepNulls): mixed
    {
        if ($value instanceof self) {
            return $value->toArray($keepNulls);
        }

        if ($value instanceof BackedEnum) {
            return $value->value;
        }

        if (is_array($value)) {
            $result = [];
            foreach ($value as $key => $item) {
                if ($item === null && !$keepNulls) {
                    continue;
                }
                $result[$key] = self::normalizeValue($item, $keepNulls);
            }
            return $result;
        }

        return $value;
    }
}
