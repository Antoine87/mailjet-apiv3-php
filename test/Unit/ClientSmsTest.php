<?php

declare(strict_types=1);

namespace MailjetTest\Unit;

use Mailjet\ClientSms;
use PHPUnit\Framework\TestCase;

class ClientSmsTest extends TestCase
{
    public function test_new_client_validate_token(): void
    {
        $this->expectExceptionMessage('Invalid token given');

        new ClientSms('foo');
    }

    public function test_can_retrieve_client_auth_after_construct(): void
    {
        $token = '0123456789abcdef0123456789abcdef';

        $client = new ClientSms($token);

        $this->assertSame($token, $client->getToken());
    }
}
