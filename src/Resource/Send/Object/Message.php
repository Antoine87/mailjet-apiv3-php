<?php

declare(strict_types=1);

namespace Mailjet\Resource\Send\Object;

use Mailjet\Exception\InvalidArgument;
use Mailjet\Resource\ResourceObjectInterface;

class Message implements ResourceObjectInterface
{
    /** @var Email */
    private $from;

    /** @var Email[] */
    private $to;

    public static function from(Email $email): self
    {
        $message = new static;
        $message->from = $email;

        return $message;
    }

    public function to(array $emails): self
    {
        foreach ($emails as $email) {
            if (!$email instanceof Email) {
                throw InvalidArgument::withMessage('Every emails must be instances of Send\\Object\\Email');
            }
        }
        $this->to = $emails;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'From' => $this->from->toArray(),
            'To' => []
        ];

        foreach ($this->to as $email) {
            $array['To'][] = $email->toArray();
        }

        return $array;
    }
}
