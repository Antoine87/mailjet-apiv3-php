<?php

declare(strict_types=1);

namespace Mailjet\Resource;

interface ResourceObjectInterface
{
    public function toArray(): array;
}
