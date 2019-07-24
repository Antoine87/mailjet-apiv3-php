<?php

declare(strict_types=1);

namespace MailjetTest\Unit;

use Mailjet\ClientEmail;
use PHPUnit\Framework\TestCase;

class ClientEmailTest extends TestCase
{
    public function test_new_client_validate_api_key(): void
    {
        $this->expectExceptionMessage('Invalid api key given');

        new ClientEmail('foo', '0123456789abcdef0123456789abcdef');
    }

    public function test_new_client_validate_secret_key(): void
    {
        $this->expectExceptionMessage('Invalid secret key given');

        new ClientEmail('0123456789abcdef0123456789abcdef', 'foo');
    }

    public function test_can_retrieve_client_auth_after_construct(): void
    {
        $apiKey = '0123456789abcdef0123456789abcdef';
        $secretKey = 'abcdef0123456789abcdef0123456789';

        $client = new ClientEmail($apiKey, $secretKey);

        $this->assertSame($apiKey, $client->getApiKey());
        $this->assertSame($secretKey, $client->getSecretKey());
    }
}
