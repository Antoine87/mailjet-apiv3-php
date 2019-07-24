<?php

declare(strict_types=1);

namespace Mailjet\Internal;

use function json_encode;

/**
 * @internal
 */
final class Json
{
    public static function encode(array $payload): string
    {
        return json_encode($payload);
    }
}
