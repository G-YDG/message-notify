<?php

declare(strict_types=1);

namespace Ydg\MessageNotice\Template;

class Text extends AbstractTemplate
{
    public function getDingTalkBody(): array
    {
        return [
            'msgtype' => 'text',
            'text' => [
                'content' => $this->getText(),
            ],
            'at' => [
                'isAtAll' => $this->isAtAll(),
                'atMobiles' => $this->getAt(),
            ],
        ];
    }

    public function getFeiShuBody(): array
    {
        return [
            'msg_type' => 'text',
            'content' => [
                'text' => $this->getText() . $this->getFeiShuAt(),
            ],
        ];
    }

    public function getWorkWechatBody(): array
    {
        return [
            'msgtype' => 'text',
            'text' => [
                'content' => $this->getText(),
                'mentioned_list' => in_array('all', $this->getAt()) ? [] : [$this->getAt()],
                'mentioned_mobile_list' => in_array('all', $this->getAt()) ? ['@all'] : [$this->getAt()],
            ],
        ];
    }

    protected function getFeiShuAt(): string
    {
        if ($this->isAtAll()) {
            return '<at user_id="all">所有人</at>';
        }

        $at = $this->getAt();
        $result = '';
        foreach ($at as $item) {
            if (strchr($item, '@') === false) {
                $result .= '<at phone="' . $item . '">' . $item . '</at>';
            } else {
                $result .= '<at email="' . $item . '">' . $item . '</at>';
            }
        }
        return $result;
    }
}
