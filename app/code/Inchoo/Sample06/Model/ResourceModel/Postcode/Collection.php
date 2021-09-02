<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Model\ResourceModel\Postcode;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Inchoo\Sample06\Model\Postcode::class,
            \Inchoo\Sample06\Model\ResourceModel\Postcode::class
        );
        $this->_setIdFieldName('entity_id');
    }
}
