<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Postcode extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('inchoo_postcode', 'entity_id');
    }
}
