<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Plugin;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;

/**
 * Appends 'AFTER' to product name if the product is loaded with get() or getById()
 */
class ProductRepositoryInterfacePlugin
{
    /**
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $result
     * @return ProductInterface
     */
    public function afterGet(ProductRepositoryInterface $subject, ProductInterface $result): ProductInterface
    {
        $result->setName($result->getName() . 'AFTER');
        return $result;
    }

    /**
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $result
     * @return ProductInterface
     */
    public function afterGetById(ProductRepositoryInterface $subject, ProductInterface $result): ProductInterface
    {
        $result->setName($result->getName() . 'AFTER');
        return $result;
    }
}
