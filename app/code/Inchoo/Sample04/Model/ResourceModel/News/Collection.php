<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Model\ResourceModel\News;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct() // notice one underscore in method name
    {
        $this->_init(
            \Inchoo\Sample04\Model\News::class,
            \Inchoo\Sample04\Model\ResourceModel\News::class
        );
        $this->_setIdFieldName('entity_id');
    }
}
