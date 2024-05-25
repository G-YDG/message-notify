<?php

declare(strict_types=1);

namespace Ydg\MessageNotice\Channel;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Ydg\MessageNotice\Template\AbstractTemplate;

abstract class AbstractChannel
{
    protected $config;

    public function __construct($config)
    {
        $this->config = is_array($config) ? $config : ['url' => $config];
    }

    abstract public function send(AbstractTemplate $template): bool;

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

    protected function doSendRequest(AbstractTemplate $template)
    {
        $client = $this->getClient();

        $option = [
            RequestOptions::HEADERS => [],
            RequestOptions::JSON => $template->getBody(),
        ];
        $request = $client->post($this->getUrl(), $option);
        return json_decode($request->getBody()->getContents(), true);
    }

    public function getClient(): ClientInterface
    {
        return new Client();
    }
}
