<?php

declare(strict_types=1);

namespace Inchoo\Sample05\Model\ResourceModel\Event;

use Inchoo\Sample05\Api\Data\EventInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Inchoo\Sample05\Model\Event::class,
            \Inchoo\Sample05\Model\ResourceModel\Event::class
        );
        $this->_setIdFieldName(EventInterface::ENTITY_ID);
    }
}
