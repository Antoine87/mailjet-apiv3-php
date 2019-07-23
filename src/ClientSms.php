<?php

declare(strict_types=1);

namespace Mailjet;

use Mailjet\Exception\InvalidArgument;

class ClientSms
{
    public function __construct(string $token)
    {
        if (!ApiKey::isValid($token)) {
            throw InvalidArgument::withMessage('Invalid token given');
        }
    }
}
