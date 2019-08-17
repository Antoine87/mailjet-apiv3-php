<?php

declare(strict_types=1);

namespace Mailjet\Resource\Send\Object;

use Mailjet\Resource\ResourceObjectInterface;

class InlinedAttachment implements ResourceObjectInterface
{
    /** @var string */
    private $filename;
    /** @var string */
    private $contentType;
    /** @var string */
    private $base64Content;
    /** @var string */
    private $contentId;

    public static function file(string $filename, string $contentType, string $base64Content): self
    {
        $attachment = new static;
        $attachment->filename = $filename;
        $attachment->contentType = $contentType;
        $attachment->base64Content = $base64Content;

        return $attachment;
    }

    public function withContentId(string $contentId): self
    {
        $this->contentId = $contentId;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'Filename' => $this->filename,
            'ContentType' => $this->contentType,
            'Base64Content' => $this->base64Content,
        ];

        if ($this->contentId) {
            $array['ContentID'] = $this->contentId;
        }

        return $array;
    }

    private function __construct()
    {
    }
}
