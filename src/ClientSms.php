<?php

declare(strict_types=1);

namespace Mailjet;

use Mailjet\Exception\InvalidArgument;

class ClientSms
{
    private $token;

    public function __construct(
        string $token,
        string $scheme = 'https',
        string $authority = 'api.mailjet.com'
    ) {
        if (!ApiKey::isValid($token)) {
            throw InvalidArgument::withMessage('Invalid token given');
        }
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
