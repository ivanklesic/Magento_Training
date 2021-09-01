<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Model;

use Magento\Framework\Model\AbstractModel;

class Comment extends AbstractModel
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Inchoo\Sample04\Model\ResourceModel\Comment::class);
    }
}
