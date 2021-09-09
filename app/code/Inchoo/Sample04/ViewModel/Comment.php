<?php

declare(strict_types=1);

namespace Inchoo\Sample04\ViewModel;

use Inchoo\Sample04\Model\Comment as CommentModel;
use Inchoo\Sample04\Model\ResourceModel\Comment\Collection;
use Inchoo\Sample04\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Framework\DataObject;
use Magento\Framework\Registry;
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
     * @var Registry
     */
    protected $registry;

    /**
     * News constructor.
     * @param CollectionFactory $collectionFactory
     * @param Registry $registry
     */
    public function __construct(CollectionFactory $collectionFactory, Registry $registry)
    {
        $this->collectionFactory = $collectionFactory;
        $this->registry = $registry;
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

    /**
     * @return CommentModel|null
     */
    public function getCurrentComment(): ?CommentModel
    {
        return $this->registry->registry('current_comment');
    }
}
