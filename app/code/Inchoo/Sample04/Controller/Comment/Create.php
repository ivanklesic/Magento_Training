<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Controller\Comment;

use Inchoo\Sample04\Model\CommentFactory;
use Inchoo\Sample04\Model\ResourceModel\Comment as CommentResource;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Math\Random;
use Magento\Framework\Message\ManagerInterface;

class Create implements HttpGetActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var Random
     */
    protected $random;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var CommentResource
     */
    protected $commentResource;

    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Create constructor.
     * @param ResultFactory $resultFactory
     * @param Random $random
     * @param ManagerInterface $messageManager
     * @param CommentResource $commentResource
     * @param CommentFactory $commentFactory,
     * @param RequestInterface $request
     */
    public function __construct(
        ResultFactory $resultFactory,
        Random $random,
        ManagerInterface $messageManager,
        CommentResource $commentResource,
        CommentFactory $commentFactory,
        RequestInterface $request
    ) {
        $this->resultFactory = $resultFactory;
        $this->random = $random;
        $this->messageManager = $messageManager;
        $this->commentResource = $commentResource;
        $this->commentFactory = $commentFactory;
        $this->request = $request;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        if (!$newsId = $this->request->getParam('id')) {
            $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
            return $resultForward->forward('noroute');
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('sample04/news/view/id/' . $newsId);

        try {
            $randomContent = $this->random->getRandomString(64);
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addErrorMessage(__('Could not create a random string.'));
            return $resultRedirect;
        }

        $comment = $this->commentFactory->create();
        $comment->setComment($randomContent);
        $comment->setNewsId($newsId);

        try {
            $this->commentResource->save($comment);
            $this->messageManager->addSuccessMessage(__('Comment successfully created!'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultRedirect;
    }
}
