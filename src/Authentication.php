<?php

declare(strict_types=1);

namespace Mailjet;

final class Authentication
{
    private $username;
    private $password;

    public static function fromApiKeys(string $public, string $private): self
    {
        return new static($public, $private);
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }

    private function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
}
