<?php

declare(strict_types=1);

namespace MailjetTest;

use Mailjet\ClientSms;
use PHPUnit\Framework\TestCase;

class ClientSmsTest extends TestCase
{
    public function test_new_client_validate_given_token():void
    {
        $this->expectExceptionMessage('Invalid token given');

        new ClientSms('foo');
    }

}
