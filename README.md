# 消息通知组件

## 介绍

* 快速便捷的开发消息通知
* 支持钉钉、飞书、企业微信以及自定义通知渠道
* 支持文本、markdown以及自定义消息模板

## 安装

```bash
$ composer require ydg/message-notify
```

## 使用

```php
<?php

use Ydg\MessageNotice\Channel\DingTalkChannel;
use Ydg\MessageNotice\MessageNotify;
use Ydg\MessageNotice\Template\Text;

MessageNotify::make()
    ->setChannel(DingTalkChannel::class, 'https://oapi.dingtalk.com/robot/send?access_token=xxx')
    ->setTitle('标题')
    ->setText('通知测试')
    ->setTemplate(Text::class)
    ->send();
```

## 协议

MIT 许可证（MIT）。有关更多信息，请参见[协议文件](LICENSE)。