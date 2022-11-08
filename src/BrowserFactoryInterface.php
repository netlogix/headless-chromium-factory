<?php

declare(strict_types=1);

namespace Netlogix\HeadlessChromiumFactory;

use HeadlessChromium\Browser;

interface BrowserFactoryInterface
{
    public function createBrowser(): Browser;
}
