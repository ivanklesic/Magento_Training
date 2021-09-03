<?php

declare(strict_types=1);

namespace Inchoo\Sample04\ViewModel;

use Inchoo\Sample04\Model\News as NewsModel;
use Inchoo\Sample04\Model\ResourceModel\News\Collection;
use Inchoo\Sample04\Model\ResourceModel\News\CollectionFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class News implements ArgumentInterface
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * News constructor.
     * @param Registry $registry
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Registry $registry, CollectionFactory $collectionFactory)
    {
        $this->registry = $registry;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return NewsModel|null
     */
    public function getCurrentNews(): ?NewsModel
    {
        return $this->registry->registry('current_news');
    }

    /**
     * @return Collection|NewsModel[]
     */
    public function getNewsList($getAllNews = false): Collection
    {
        $collection = $this->collectionFactory->create();
        if($getAllNews){
            return $collection;
        }
        $collection->setOrder('created_at');
        $collection->setPageSize(5);
        $collection->setCurPage(1);
        $collection->addFilter('status', true);

        return $collection;
    }


}
