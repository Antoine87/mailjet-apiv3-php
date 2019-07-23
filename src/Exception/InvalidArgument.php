<?php

declare(strict_types=1);

namespace Mailjet\Exception;

final class InvalidArgument extends \InvalidArgumentException implements ExceptionInterface
{
    public static function withMessage(string $message)
    {
        return new static($message);
    }

    private function __construct(string $message)
    {
        parent::__construct($message);
    }
}
