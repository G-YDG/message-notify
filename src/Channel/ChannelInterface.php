<?php

namespace Ydg\MessageNotice\Channel;

interface ChannelInterface
{
    /**
     * 发送请求
     * @return mixed
     */
    public function send(): bool;
}