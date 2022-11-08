<?php

declare(strict_types=1);

namespace Netlogix\HeadlessChromiumFactory;

use HeadlessChromium\Browser;
use HeadlessChromium\BrowserFactory;

class LocalBrowserFactory implements BrowserFactoryInterface
{
    protected BrowserFactory $browserFactory;

    protected array $browserOptions;

    public function __construct(string $chromeBinary, array $browserOptions)
    {
        $this->browserFactory = new BrowserFactory($chromeBinary);
        $this->browserOptions = $browserOptions;
    }

    public function createBrowser(): Browser
    {
        return $this->browserFactory->createBrowser($this->browserOptions);
    }
}
