<?php

declare(strict_types=1);

namespace Mailjet\Resource\Send;

use Mailjet\Resource\EndpointInterface;

class SendV31 implements EndpointInterface
{
    /** @var bool */
    private $sandbox = false;

    /** @var Object\Message[] */
    private $messages;

    public static function method(): string
    {
        return 'POST';
    }

    public static function path(): string
    {
        return 'v3.1/send';
    }

    public static function messages(array $messages): self
    {
        $send = new static();
        $send->messages = $messages;

        return $send;
    }

    public function payload(): array
    {
        $payload = [
            'SandBoxMode' => $this->sandbox,
            'Messages' => []
        ];

        foreach ($this->messages as $message) {
            $payload['Messages'][] = $message->toArray();
        }

        return $payload;
    }

    public function inSandboxMode(): self
    {
        $this->sandbox = true;

        return $this;
    }

    private function __construct()
    {
    }
}
