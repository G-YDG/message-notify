<?php

declare(strict_types=1);

namespace YdgTest\MessageNotice;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
abstract class AbstractTest extends TestCase
{
    protected function getConfig($key): array
    {
        $config = [
            'DingTalk' => [
                'url' => getenv('DING_TALK_URL'),
            ],
            'FeiShu' => [
                'url' => getenv('FEI_SHU_URL'),
            ],
            'WorkWechat' => [
                'url' => getenv('WORK_WECHAT_URL'),
            ],
        ];
        return $config[$key] ?? [];
    }
}
