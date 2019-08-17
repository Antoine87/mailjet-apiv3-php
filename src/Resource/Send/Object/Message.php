<?php

declare(strict_types=1);

namespace Mailjet\Resource\Send\Object;

use Mailjet\Exception\InvalidArgument;
use Mailjet\Resource\ResourceObjectInterface;

class Message implements ResourceObjectInterface
{
    /** @var Email */
    private $from;
    /** @var Email[] */
    private $to;
    /** @var Email */
    private $sender;
    /** @var Email[] */
    private $cc;
    /** @var Email[] */
    private $bcc;
    /** @var Email[] */
    private $replyTo;
    /** @var string */
    private $subject;
    /** @var string */
    private $textPart;
    /** @var string */
    private $htmlPart;
    /** @var int */
    private $templateId;
    /** @var bool */
    private $templateLanguage;
    /** @var Email */
    private $templateErrorReporting;
    /** @var bool */
    private $templateErrorDeliver;
    /** @var Attachment[] */
    private $attachments;
    /** @var InlinedAttachment[] */
    private $inlinedAttachments;
    /** @var int */
    private $priority;

    public static function from(Email $email): self
    {
        $message = new static;
        $message->from = $email;

        return $message;
    }

    public function to(array $emails): self
    {
        $this->validateEmails($emails);
        $this->to = $emails;

        return $this;
    }

    public function sender(Email $email): self
    {
        $this->sender = $email;

        return $this;
    }

    public function cc(array $emails): self
    {
        $this->validateEmails($emails);
        $this->cc = $emails;

        return $this;
    }

    public function bcc(array $emails): self
    {
        $this->validateEmails($emails);
        $this->bcc = $emails;

        return $this;
    }

    public function replyTo(array $emails): self
    {
        $this->validateEmails($emails);
        $this->replyTo = $emails;

        return $this;
    }

    public function subject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function textPart(string $text): self
    {
        $this->textPart = $text;

        return $this;
    }

    public function htmlPart(string $html): self
    {
        $this->htmlPart = $html;

        return $this;
    }

    public function templateId(int $id): self
    {
        $this->templateId = $id;

        return $this;
    }

    public function templateLanguage(bool $activateProcessing): self
    {
        $this->templateLanguage = $activateProcessing;

        return $this;
    }

    public function templateErrorReporting(Email $email): self
    {
        $this->templateErrorReporting = $email;

        return $this;
    }

    public function templateErrorDeliver(bool $proceedDeliveryOnError): self
    {
        $this->templateErrorDeliver = $proceedDeliveryOnError;

        return $this;
    }

    public function attachments(array $files): self
    {
        foreach ($files as $attachment) {
            if (!$attachment instanceof Attachment) {
                throw InvalidArgument::withMessage('Every attachment must be instances of Send\\Object\\Attachment');
            }
        }
        $this->attachments = $files;

        return $this;
    }

    public function inlinedAttachments(array $files): self
    {
        foreach ($files as $attachment) {
            if (!$attachment instanceof InlinedAttachment) {
                throw InvalidArgument::withMessage(
                    'Every inline attachment must be instances of Send\\Object\\InlinedAttachment'
                );
            }
        }
        $this->inlinedAttachments = $files;

        return $this;
    }

    public function priority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'From' => $this->from->toArray(),
            'To' => []
        ];
        $this
            ->addParamObject($array, 'To', $this->to)
            ->addParamObject($array, 'Sender', $this->sender)
            ->addParamObject($array, 'Cc', $this->cc)
            ->addParamObject($array, 'Bcc', $this->bcc)
            ->addParamObject($array, 'ReplyTo', $this->replyTo)
            ->addParam($array, 'Subject', $this->subject)
            ->addParam($array, 'TextPart', $this->textPart)
            ->addParam($array, 'HTMLPart', $this->htmlPart)
            ->addParam($array, 'TemplateID', $this->templateId)
            ->addParam($array, 'TemplateLanguage', $this->templateLanguage)
            ->addParamObject($array, 'TemplateErrorReporting', $this->templateErrorReporting)
            ->addParam($array, 'TemplateErrorDeliver', $this->templateErrorDeliver)
            ->addParamObject($array, 'Attachments', $this->attachments)
            ->addParamObject($array, 'InlinedAttachments', $this->inlinedAttachments)
            ->addParam($array, 'Priority', $this->priority)
        ;

        return $array;
    }

    private function addParamObject(array &$array, string $key, $objects): self
    {
        if ($objects) {
            $array[$key] = [];
            /** @var ResourceObjectInterface $object */
            foreach ($objects as $object) {
                $array[$key][] = $object->toArray();
            }
        }

        return $this;
    }

    private function addParam(array &$array, string $key, $value): self
    {
        if ($value) {
            $array[$key] = $value;
        }

        return $this;
    }

    private function validateEmails(array $emails): void
    {
        foreach ($emails as $email) {
            if (!$email instanceof Email) {
                throw InvalidArgument::withMessage('Every emails must be instances of Send\\Object\\Email');
            }
        }
    }
}
