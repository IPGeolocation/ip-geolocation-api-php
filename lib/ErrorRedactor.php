<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

/** @internal */
final class ErrorRedactor
{
    public static function text(string $text, ?string $key): string
    {
        if ($key === null || $key === '') {
            return $text;
        }

        $encoded = [rawurlencode($key), urlencode($key)];
        foreach ($encoded as $value) {
            $text = str_ireplace($value, '[REDACTED]', $text);
        }
        $json = json_encode($key, JSON_INVALID_UTF8_SUBSTITUTE);
        return str_replace([$key, substr($json, 1, -1)], '[REDACTED]', $text);
    }

    public static function exception(\Throwable $error, ?string $key): \Throwable
    {
        if ($key === null) {
            return $error;
        }

        $message = self::text($error->getMessage(), $key);
        if ($error instanceof ApiException) {
            $class = get_class($error);
            $copy = new $class($message, $error->status_code, $error->api_message === null ? null : self::text($error->api_message, $key));
        } elseif ($error instanceof \Error) {
            $class = get_class($error);
            $copy = new $class($message, $error->getCode());
        } else {
            $class = match (true) {
                $error instanceof RequestTimeoutException => RequestTimeoutException::class,
                $error instanceof TransportException => TransportException::class,
                $error instanceof SerializationException => SerializationException::class,
                $error instanceof ValidationException => ValidationException::class,
                default => TransportException::class,
            };
            $copy = new $class($message);
        }

        // Trace arguments can retain requests and credentials, including on PHP 8.1.
        $trace = array_map(static function (array $frame): array {
            unset($frame['args'], $frame['object']);
            return $frame;
        }, $error->getTrace());
        (new \ReflectionProperty($copy instanceof \Error ? \Error::class : \Exception::class, 'trace'))->setValue($copy, $trace);
        return $copy;
    }
}
