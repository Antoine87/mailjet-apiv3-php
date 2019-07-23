<?php

declare(strict_types=1);

namespace Mailjet;

use Mailjet\Exception\InvalidArgument;

class ClientEmail
{
    public function __construct(string $apiKey, string $secretKey)
    {
        if (!ApiKey::isValid($apiKey)) {
            throw InvalidArgument::withMessage('Invalid api key given');
        }
        if (!ApiKey::isValid($secretKey)) {
            throw InvalidArgument::withMessage('Invalid secret key given');
        }
    }
}
