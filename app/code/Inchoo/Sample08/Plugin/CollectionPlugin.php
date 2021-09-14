<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Plugin;

use Magento\Catalog\Model\ResourceModel\Product\Collection;

class CollectionPlugin
{
    /**
     * @param Collection $subject
     * @param bool $printQuery
     * @param bool $logQuery
     * @return array
     */
    public function beforeLoad(Collection $subject, bool $printQuery, bool $logQuery): array
    {
        return [false, $logQuery];
    }
}
