<?php

declare(strict_types=1);

namespace Netlogix\HeadlessChromiumFactory;

use HeadlessChromium\Browser;
use Psr\Log\LoggerInterface;

interface BrowserFactoryInterface
{
    public function createBrowser(?LoggerInterface $logger = null, ?int $sendSyncDefaultTimeout = null): Browser;
}
