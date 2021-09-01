<?php

declare(strict_types=1);

namespace Inchoo\Sample04\ViewModel;

use Inchoo\Sample04\Model\Comment as CommentModel;
use Inchoo\Sample04\Model\ResourceModel\Comment\Collection;
use Inchoo\Sample04\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 *
 */
class Comment implements ArgumentInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * News constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param int $newsId
     * @return Collection
     */
    public function getCommentList(int $newsId): Collection
    {
        $collection = $this->collectionFactory->create();
        $collection->addFilter('news_id', $newsId);
        return $collection;
    }
}
