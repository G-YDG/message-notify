<?php

declare(strict_types=1);

namespace Ydg\MessageNotice;

use Ydg\MessageNotice\Channel\AbstractChannel;
use Ydg\MessageNotice\Exception\MessageNotificationException;
use Ydg\MessageNotice\Template\AbstractTemplate;
use Ydg\MessageNotice\Template\Text;

class Client
{
    protected $channel;

    protected $template;

    protected $at = [];

    protected $title = '';

    protected $text = '';

    private $errorMessage;

    public function send(): bool
    {
        try {
            $template = $this
                ->getTemplate()
                ->setAt($this->getAt())
                ->setTitle($this->getTitle())
                ->setText($this->getText());

            $this->getChannel()->send($template);
            return true;
        } catch (MessageNotificationException $exception) {
            $this->errorMessage = $exception->getMessage();
            return false;
        }
    }

    public function getTemplate(): AbstractTemplate
    {
        return $this->template ?? new Text();
    }

    public function setTemplate($template = ''): Client
    {
        if (! $template instanceof AbstractTemplate) {
            $template = new $template();
        }

        $this->template = $template;
        return $this;
    }

    public function getAt(): array
    {
        return $this->at;
    }

    public function setAt(array $at = []): Client
    {
        $this->at = $at;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title = ''): Client
    {
        $this->title = $title;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text = ''): Client
    {
        $this->text = $text;
        return $this;
    }

    public function getChannel(): AbstractChannel
    {
        return $this->channel;
    }

    public function setChannel($channel = null, $config = null): Client
    {
        if (! $channel instanceof AbstractChannel) {
            $channel = new $channel($config ?? []);
        }
        $this->channel = $channel;
        return $this;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
