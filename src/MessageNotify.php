<?php

namespace Ydg\MessageNotice;

class MessageNotify
{
    public static function make(): Client
    {
        return new Client();
    }
}