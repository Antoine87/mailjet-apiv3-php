<?php

declare(strict_types=1);

namespace Mailjet;

class ApiKey
{
    public static function isValid(string $apiKey): bool
    {
        return (bool) preg_match('/^[0-9a-f]{32}$/', $apiKey);
    }

    private function __construct()
    {
    }
}
