<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Controller\Comment;

use Inchoo\Sample04\Model\CommentFactory;
use Inchoo\Sample04\Model\ResourceModel\Comment as CommentResource;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Setup\Exception;

class Delete implements HttpGetActionInterface
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
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * View constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param CommentResource $commentResource
     * @param CommentFactory $commentFactory
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        CommentResource $commentResource,
        CommentFactory $commentFactory,
        ManagerInterface $messageManager
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->commentResource = $commentResource;
        $this->commentFactory = $commentFactory;
        $this->messageManager = $messageManager;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);

        if (!$commentId = $this->request->getParam('id')) {
            return $resultForward->forward('noroute');
        }

        $comment = $this->commentFactory->create();
        $this->commentResource->load($comment, $commentId);

        if(!$comment->getId()) {
            return $resultForward->forward('noroute');
        }

        try {
            $this->commentResource->delete($comment);
        } catch (Exception $exception) {
            $this->messageManager->addErrorMessage(__('Could not delete comment.'));
        }

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('sample04/news/list');
    }
}

