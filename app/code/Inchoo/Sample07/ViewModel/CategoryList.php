<?php

declare(strict_types=1);

namespace Inchoo\Sample07\ViewModel;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\ResourceModel\Category\Collection;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CategoryList implements ArgumentInterface
{
    /**
     * @var Collection|null
     */
    private $loadedCategoryCollection;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * CategoryList constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return Category[]
     */
    public function getCategories(): array
    {
        return $this->getLoadedCategoryCollection()->getItems();
    }

    /**
     * @return Collection
     */
    protected function getLoadedCategoryCollection(): Collection
    {
        if ($this->loadedCategoryCollection) {
            return $this->loadedCategoryCollection;
        }

        $collection = $this->collectionFactory->create();
        $collection->addAttributeToSelect(['name', 'custom_description', 'url']);
        $collection->addAttributeToFilter('is_active', ['neq' => 0]);
        $collection->addAttributeToFilter('level', 2);
        $collection->addAttributeToSort('position');
        $collection->setPageSize(10);

        $this->loadedCategoryCollection = $collection->load();
        return $this->loadedCategoryCollection;
    }
}
