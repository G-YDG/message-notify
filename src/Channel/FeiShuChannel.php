<?php

declare(strict_types=1);

namespace Ydg\MessageNotice\Channel;

use Ydg\MessageNotice\Exception\MessageNotificationException;
use Ydg\MessageNotice\Template\AbstractTemplate;

class FeiShuChannel extends AbstractChannel
{
    public function send(AbstractTemplate $template): bool
    {
        $template->setBody($template->getFeiShuBody());
        $result = $this->doSendRequest($template);
        if (! isset($result['StatusCode']) || $result['StatusCode'] !== 0) {
            throw new MessageNotificationException($result['msg']);
        }
        return true;
    }

    protected function getUrl(): string
    {
        return $this->getConfig()['url'] ?? '';
    }
}
