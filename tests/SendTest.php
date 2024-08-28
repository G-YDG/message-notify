<?php

declare(strict_types=1);

use Ydg\MessageNotice\Channel\DingTalkChannel;
use Ydg\MessageNotice\Channel\FeiShuChannel;
use Ydg\MessageNotice\Channel\WorkWechatChannel;
use Ydg\MessageNotice\MessageNotify;
use Ydg\MessageNotice\Template\Markdown;
use Ydg\MessageNotice\Template\Text;
use YdgTest\MessageNotice\AbstractTest;

/**
 * @internal
 * @coversNothing
 */
class SendTest extends AbstractTest
{
    public function testSendTextByDingTalk()
    {
        $result = MessageNotify::make()
            ->setChannel(DingTalkChannel::class, $this->getConfig('DingTalk'))
            ->setTitle('标题')
            ->setText('通知测试')
            ->setTemplate(Text::class)
            ->send();

        $this->assertEquals($result, true);
    }

    public function testSendTextByFeiShu()
    {
        $result = MessageNotify::make()
            ->setChannel(FeiShuChannel::class, $this->getConfig('FeiShu'))
            ->setTitle('标题')
            ->setText('通知测试')
            ->setTemplate(Text::class)
            ->send();

        $this->assertEquals($result, true);
    }

    public function testSendTextByWorkWechat()
    {
        $result = MessageNotify::make()
            ->setChannel(WorkWechatChannel::class, $this->getConfig('WorkWechat'))
            ->setTitle('标题')
            ->setText('通知测试')
            ->setTemplate(Text::class)
            ->send();

        $this->assertEquals($result, true);
    }

    public function testSendMarkdownByDingTalk()
    {
        $result = MessageNotify::make()
            ->setChannel(DingTalkChannel::class, $this->getConfig('DingTalk'))
            ->setTitle('标题')
            ->setText("## 通知\n ##### 标题：通知测试\n ##### 时间：" . date('Y-m-d H:i:s'))
            ->setTemplate(Markdown::class)
            ->send();

        $this->assertEquals($result, true);
    }

    public function testSendarkdownByFeiShu()
    {
        $result = MessageNotify::make()
            ->setChannel(FeiShuChannel::class, $this->getConfig('FeiShu'))
            ->setTitle('标题')
            ->setText("标题：通知测试\n时间：" . date('Y-m-d H:i:s'))
            ->setTemplate(Markdown::class)
            ->send();

        $this->assertEquals($result, true);
    }

    public function testSendRichTextByFeiShu()
    {
        $test = json_encode([
            [
                [
                    'tag' => 'text',
                    'text' => '标题：',
                ],
                [
                    'tag' => 'text',
                    'text' => '这是标题',
                ],
            ],
            [
                [
                    'tag' => 'text',
                    'text' => '详情：',
                ],
                [
                    'tag' => 'a',
                    'text' => '点击查看',
                    'href' => 'https://www.baidu.com'
                ],
            ],
            [
                [
                    'tag' => 'at',
                    'user_id' => 'all',
                ],
            ],
        ]);
        $result = MessageNotify::make()
            ->setChannel(FeiShuChannel::class, $this->getConfig('FeiShu'))
            ->setTitle('标题')
            ->setText($test)
            ->setTemplate(Markdown::class)
            ->setAt(['all'])
            ->send();


        $this->assertEquals($result, true);
    }

    public function testSendarkdownByWorkWechat()
    {
        $result = MessageNotify::make()
            ->setChannel(WorkWechatChannel::class, $this->getConfig('WorkWechat'))
            ->setTitle("# 标题\n")
            ->setText("标题：通知测试\n时间：" . date('Y-m-d H:i:s'))
            ->setTemplate(Markdown::class)
            ->send();

        $this->assertEquals($result, true);
    }

    public function testAtAllByDingTalk()
    {
        $result = MessageNotify::make()
            ->setChannel(WorkWechatChannel::class, $this->getConfig('WorkWechat'))
            ->setAt(['all'])
            ->setTitle('标题')
            ->setText('所有人员-通知测试')
            ->setTemplate(Text::class)
            ->send();

        $this->assertEquals($result, true);
    }

    public function testAtAllByFeiShu()
    {
        $result = MessageNotify::make()
            ->setChannel(WorkWechatChannel::class, $this->getConfig('WorkWechat'))
            ->setAt(['all'])
            ->setTitle('标题')
            ->setText('所有人员-通知测试')
            ->setTemplate(Text::class)
            ->send();

        $this->assertEquals($result, true);
    }

    public function testAtAllByWorkWechat()
    {
        $result = MessageNotify::make()
            ->setChannel(WorkWechatChannel::class, $this->getConfig('WorkWechat'))
            ->setAt(['all'])
            ->setTitle('标题')
            ->setText('所有人员-通知测试')
            ->setTemplate(Text::class)
            ->send();

        $this->assertEquals($result, true);
    }

    public function testMultiChannel()
    {
        $client = MessageNotify::make();

        $client->setTitle('标题')->setText('通知测试')->setTemplate(Text::class);

        $channels = [
            DingTalkChannel::class => $this->getConfig('DingTalk'),
            FeiShuChannel::class => $this->getConfig('FeiShu'),
            WorkWechatChannel::class => $this->getConfig('WorkWechat'),
        ];

        foreach ($channels as $channel => $channelConfig) {
            $result = $client->setChannel($channel, $channelConfig)->send();
            $this->assertEquals($result, true);
        }
    }
}
