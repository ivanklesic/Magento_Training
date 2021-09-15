<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Plugin;

use Magento\Catalog\Model\ResourceModel\Product\Collection;

/**
 * Sets the $printQuery parameter to false before calling the load() method in Collection
 */
class ProductCollectionPlugin
{
    /**
     * @param Collection $subject
     * @param bool $printQuery
     * @param bool $logQuery
     * @return array
     */
    public function beforeLoad(Collection $subject, bool $printQuery = false, bool $logQuery = false): array
    {
        if($printQuery){
            $printQuery = false;
        }

        return [$printQuery, $logQuery];
    }
}
