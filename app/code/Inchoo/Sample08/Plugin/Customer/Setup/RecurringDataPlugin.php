<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Plugin\Customer\Setup;

use Magento\Customer\Setup\RecurringData;

/**
 * Prevents the install() method and its other plugins from executing
 */
class RecurringDataPlugin
{
    public function aroundInstall(RecurringData $subject, callable $proceed)
    {

    }
}
