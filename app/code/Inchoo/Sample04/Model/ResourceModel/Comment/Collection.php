<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Inchoo\Sample04\Model\Comment::class,
            \Inchoo\Sample04\Model\ResourceModel\Comment::class
        );
        $this->_setIdFieldName('entity_id');
    }
}
