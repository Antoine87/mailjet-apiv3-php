<?php

declare(strict_types=1);

namespace Mailjet\Resource\Send\Object;

use Mailjet\Resource\ResourceObjectInterface;

class Attachment implements ResourceObjectInterface
{
    /** @var string */
    private $filename;
    /** @var string */
    private $contentType;
    /** @var string */
    private $base64Content;

    public static function file(string $filename, string $contentType, string $base64Content): self
    {
        $attachment = new static;
        $attachment->filename = $filename;
        $attachment->contentType = $contentType;
        $attachment->base64Content = $base64Content;

        return $attachment;
    }

    public function toArray(): array
    {
        return [
            'Filename' => $this->filename,
            'ContentType' => $this->contentType,
            'Base64Content' => $this->base64Content,
        ];
    }

    private function __construct()
    {
    }
}
