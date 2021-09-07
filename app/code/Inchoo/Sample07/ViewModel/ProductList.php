<?php

declare(strict_types=1);

namespace Inchoo\Sample07\ViewModel;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ProductList implements ArgumentInterface
{
    /**
     * @var Collection|null
     */
    private $loadedProductCollection;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * ProductList constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->getLoadedProductCollection()->getItems();
    }

    /**
     * @return Collection
     */
    protected function getLoadedProductCollection(): Collection
    {
        if ($this->loadedProductCollection) {
            return $this->loadedProductCollection;
        }

        $collection = $this->collectionFactory->create();
        $collection->addAttributeToSelect(['name', 'price', 'web_exclusive']);
        $collection->addAttributeToFilter('type_id', Type::TYPE_SIMPLE);
        $collection->addAttributeToSort('price');
        $collection->setPageSize(10);

        $this->loadedProductCollection = $collection->load();
        return $this->loadedProductCollection;
    }
}
