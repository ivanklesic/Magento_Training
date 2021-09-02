<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Model;

use Magento\Framework\Model\AbstractModel;

class Postcode extends AbstractModel
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Inchoo\Sample06\Model\ResourceModel\Postcode::class);
    }
}
