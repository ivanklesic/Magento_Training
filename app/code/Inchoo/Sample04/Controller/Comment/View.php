<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Controller\Comment;

use Inchoo\Sample04\Model\CommentFactory;
use Inchoo\Sample04\Model\ResourceModel\Comment as CommentResource;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;

class View implements HttpGetActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var CommentResource
     */
    protected $commentResource;

    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    /**
     * View constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param CommentResource $commentResource
     * @param CommentFactory $commentFactory
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        CommentResource $commentResource,
        CommentFactory $commentFactory
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->commentResource = $commentResource;
        $this->commentFactory = $commentFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        if (!$commentId = $this->request->getParam('id')) {
            $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
            return $resultForward->forward('noroute');
        }

        $comment = $this->commentFactory->create();
        $this->commentResource->load($comment, $commentId);

        if (!$comment->getEntityId()) {
            $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
            return $resultForward->forward('noroute');
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set($comment->getComment());

        $block = $resultPage->getLayout()->getBlock('inchoo_sample04_comment_view');

        $block->setData('comment', $comment);

        return $resultPage;
    }
}
