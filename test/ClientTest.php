<?php

declare(strict_types=1);

namespace MailjetTest;

use Mailjet\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testNewClient():void
    {
        $a = new Client();

        $this->assertInstanceOf(Client::class, $a);

        $this->assertTrue($a->toto());
    }
}
