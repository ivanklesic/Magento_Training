<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class News extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('inchoo_news', 'entity_id');
    }
}
