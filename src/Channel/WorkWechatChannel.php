<?php

namespace Ydg\MessageNotice\Channel;

use Ydg\MessageNotice\Exception\MessageNotificationException;
use Ydg\MessageNotice\Template\AbstractTemplate;

class WorkWechatChannel extends AbstractChannel
{
    public function send(AbstractTemplate $template): bool
    {
        $template->setBody($template->getWorkWechatBody());
        $result = $this->doSendRequest($template);
        if ($result['errcode'] !== 0) {
            throw new MessageNotificationException($result['errmsg']);
        }
        return true;
    }

    protected function getUrl(): string
    {
        return $this->getConfig()['url'] ?? '';
    }
}