<?php

declare(strict_types=1);

namespace Mailjet\Resource\Send\Object;

use Mailjet\Resource\ResourceObjectInterface;

class Email implements ResourceObjectInterface
{
    /** @var string */
    private $address;
    /** @var string */
    private $name;

    public static function address(string $address): self
    {
        $email = new static;
        $email->address = $address;

        return $email;
    }

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'Email' => $this->address
        ];

        if ($this->name) {
            $array['Name'] = $this->name;
        }

        return $array;
    }

    private function __construct()
    {
    }
}
