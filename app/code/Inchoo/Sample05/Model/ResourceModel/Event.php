<?php

declare(strict_types=1);

namespace Inchoo\Sample05\Model\ResourceModel;

use Inchoo\Sample05\Api\Data\EventInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Event extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('inchoo_event', EventInterface::ENTITY_ID);
    }
}
