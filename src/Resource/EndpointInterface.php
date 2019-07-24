<?php

declare(strict_types=1);

namespace Mailjet\Resource;

interface EndpointInterface
{
    public static function method(): string;

    public static function path(): string;

    public function payload(): array;
}
