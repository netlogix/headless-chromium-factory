<?php

declare(strict_types=1);

namespace Netlogix\HeadlessChromiumFactory;

use HeadlessChromium\Browser;
use HeadlessChromium\BrowserFactory;
use Psr\Log\LoggerInterface;

class LocalBrowserFactory implements BrowserFactoryInterface
{
    protected BrowserFactory $browserFactory;

    protected array $browserOptions;

    public function __construct(string $chromeBinary, array $browserOptions)
    {
        $this->browserFactory = new BrowserFactory($chromeBinary);
        $this->browserOptions = $browserOptions;
    }

    public function createBrowser(?LoggerInterface $logger = null, ?int $sendSyncDefaultTimeout = null): Browser
    {
        $options = $this->browserOptions;

        if ($logger !== null) {
            $options['debugLogger'] = $logger;
        }

        if ($sendSyncDefaultTimeout !== null) {
            $options['sendSyncDefaultTimeout'] = $sendSyncDefaultTimeout;
        }

        return $this->browserFactory->createBrowser($options);
    }
}
