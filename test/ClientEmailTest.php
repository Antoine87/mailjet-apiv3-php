<?php

declare(strict_types=1);

namespace MailjetTest;

use Mailjet\ClientEmail;
use PHPUnit\Framework\TestCase;

class ClientEmailTest extends TestCase
{
    public function test_new_client_validate_given_api_key():void
    {
        $this->expectExceptionMessage('Invalid api key given');

        new ClientEmail('foo', '00000000000000000000000000000000');
    }

    public function test_new_client_validate_given_secret_key():void
    {
        $this->expectExceptionMessage('Invalid secret key given');

        new ClientEmail('00000000000000000000000000000000', 'foo');
    }
}
