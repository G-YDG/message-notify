<?php

declare(strict_types=1);

namespace Ydg\MessageNotice\Template;

abstract class AbstractTemplate
{
    protected $at = [];

    protected $body = [];

    protected $text = '';

    protected $title = '';

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): AbstractTemplate
    {
        $this->text = $text;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): AbstractTemplate
    {
        $this->title = $title;
        return $this;
    }

    public function getAt(): array
    {
        return $this->at;
    }

    public function setAt(array $at = []): AbstractTemplate
    {
        $this->at = $at;
        return $this;
    }

    public function isAtAll(): bool
    {
        return in_array('all', $this->at) || in_array('ALL', $this->at);
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function setBody(array $body)
    {
        $this->body = $body;
    }
}
