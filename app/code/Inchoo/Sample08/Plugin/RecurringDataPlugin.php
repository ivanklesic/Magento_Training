<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Plugin;

use Magento\Customer\Setup\RecurringData;

class RecurringDataPlugin
{
    public function aroundInstall(RecurringData $subject, callable $proceed)
    {

    }
}
