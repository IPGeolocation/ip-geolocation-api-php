<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

class IpGeolocationException extends \RuntimeException
{
    public function __construct(string $message, public readonly ?\Throwable $cause = null)
    {
        parent::__construct($message, 0, $cause);
    }
}

class ValidationException extends IpGeolocationException
{
}

class SerializationException extends IpGeolocationException
{
}

class TransportException extends IpGeolocationException
{
}

class RequestTimeoutException extends TransportException
{
}

class ApiException extends IpGeolocationException
{
    public function __construct(
        string $message,
        public readonly int $status_code,
        public readonly ?string $api_message = null
    ) {
        parent::__construct($message);
    }
}

class BadRequestException extends ApiException
{
}

class UnauthorizedException extends ApiException
{
}

class ForbiddenException extends ApiException
{
}

class NotFoundException extends ApiException
{
}

class MethodNotAllowedException extends ApiException
{
}

class PayloadTooLargeException extends ApiException
{
}

class UnsupportedMediaTypeException extends ApiException
{
}

class LockedException extends ApiException
{
}

class RateLimitException extends ApiException
{
}

class ClientClosedRequestException extends ApiException
{
}

class ServerErrorException extends ApiException
{
}
