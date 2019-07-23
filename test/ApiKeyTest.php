<?php

declare(strict_types=1);

namespace MailjetTest;

use Mailjet\ApiKey;
use PHPUnit\Framework\TestCase;

class ApiKeyTest extends TestCase
{
    public function test_is_valid(): void
    {
        $this->assertTrue(ApiKey::isValid('00000000000000000000000000000000'));
        $this->assertTrue(ApiKey::isValid('ffffffffffffffffffffffffffffffff'));
        $this->assertTrue(ApiKey::isValid('0123456789abcdef0123456789abcdef'));
        // Note that in reality there is

        $this->assertFalse(ApiKey::isValid(''));
        $this->assertFalse(ApiKey::isValid('000000000000000000000000000000000'));
        $this->assertFalse(ApiKey::isValid('0000000000000000000000000000000'));
        $this->assertFalse(ApiKey::isValid(' 0000000000000000000000000000000 '));
        $this->assertFalse(ApiKey::isValid('0123456789abcdef0123456789abcdeg'));
    }

    public function test_is_not_an_entity(): void
    {
        $this->expectException(\Throwable::class);

        new ApiKey;
    }
}
