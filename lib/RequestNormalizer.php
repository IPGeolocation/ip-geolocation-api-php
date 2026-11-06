<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

final class RequestNormalizer
{
    /**
     * @param array<int, string> $values
     * @return array<int, string>
     */
    public static function tokens(array $values, string $field): array
    {
        $normalized = [];
        foreach ($values as $value) {
            if (!is_string($value)) {
                throw new \TypeError($field . ' values must be strings');
            }

            $token = trim($value);
            if ($token === '') {
                throw new ValidationException($field . ' values must not be blank');
            }

            $normalized[] = $token;
        }

        return $normalized;
    }

    /**
     * @param array<string, string|array<int, string>> $headers
     * @return array<string, array<int, string>>
     */
    public static function headers(array $headers): array
    {
        $normalized = [];

        foreach ($headers as $rawName => $rawValue) {
            if (!is_string($rawName)) {
                throw new \TypeError('header names must be strings');
            }

            $name = trim($rawName);
            if ($name === '') {
                throw new ValidationException('header names must not be blank');
            }

            if (preg_match('/^[!#$%&\'*+.^_`|~0-9A-Za-z-]+$/D', $rawName) !== 1) {
                throw new ValidationException('header name is not valid');
            }

            $values = is_array($rawValue) ? $rawValue : [$rawValue];
            if ($values === []) {
                throw new ValidationException('header values must not be empty');
            }

            $normalizedValues = [];
            foreach ($values as $value) {
                if (!is_string($value)) {
                    throw new \TypeError('header values must contain only strings');
                }

                $text = trim($value);
                if ($text === '') {
                    throw new ValidationException('header values must not contain blank strings');
                }

                if (preg_match('/[\\x00-\\x08\\x0a-\\x1f\\x7f]/', $value) === 1) {
                    throw new ValidationException('header value contains a control character');
                }

                $normalizedValues[] = $text;
            }

            $normalized[$name] = $normalizedValues;
        }

        return $normalized;
    }

    public static function optionalString(?string $value, string $field): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = trim($value);
        if ($normalized === '') {
            throw new ValidationException($field . ' must not be blank');
        }

        if ($field === 'user_agent' && preg_match('/[\\x00-\\x08\\x0a-\\x1f\\x7f]/', $value) === 1) {
            throw new ValidationException('user_agent contains a control character');
        }

        return $normalized;
    }

    public static function language(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = strtolower(trim($value));
        if ($normalized === '') {
            throw new ValidationException('lang must not be blank');
        }

        $allowed = ['en', 'de', 'ru', 'ja', 'fr', 'cn', 'es', 'cs', 'it', 'ko', 'fa', 'pt', 'ar'];
        if (!in_array($normalized, $allowed, true)) {
            throw new ValidationException('lang is not supported');
        }

        return $normalized;
    }
}
