<?php

declare(strict_types=1);

namespace Netlogix\HeadlessChromiumFactory;

use HeadlessChromium\Browser;
use HeadlessChromium\Communication\Connection;

class RemoteBrowserFactory implements BrowserFactoryInterface
{
    protected string $remoteDebuggingHost;

    protected int $remoteDebuggingPort;

    public function __construct(string $remoteDebuggingHost, int $remoteDebuggingPort)
    {
        $this->remoteDebuggingHost = $remoteDebuggingHost;
        $this->remoteDebuggingPort = $remoteDebuggingPort;
    }

    public function createBrowser(): Browser
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, sprintf('http://%s:%s/json/version', $this->remoteDebuggingHost, $this->remoteDebuggingPort));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Host: localhost']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = json_decode(curl_exec($ch), true);

        $websocketUrl = str_replace(
            'localhost',
            sprintf('%s:%s', $this->remoteDebuggingHost, $this->remoteDebuggingPort),
            $result['webSocketDebuggerUrl']
        );

        $connection = new Connection($websocketUrl);
        $connection->connect();

        return new Browser($connection);
    }
}
