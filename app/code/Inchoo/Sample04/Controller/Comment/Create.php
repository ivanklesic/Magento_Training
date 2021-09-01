<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Controller\Comment;

use Inchoo\Sample04\Model\CommentFactory;
use Inchoo\Sample04\Model\ResourceModel\Comment as CommentResource;
use Inchoo\Sample04\Model\ResourceModel\News as NewsResource;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Math\Random;
use Magento\Framework\Message\ManagerInterface;
use Inchoo\Sample04\Model\NewsFactory;

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
     * @var NewsFactory
     */
    protected $newsFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var NewsResource
     */
    protected $newsResource;

    /**
     * Create constructor.
     * @param ResultFactory $resultFactory
     * @param Random $random
     * @param ManagerInterface $messageManager
     * @param CommentResource $commentResource
     * @param CommentFactory $commentFactory
     * @param RequestInterface $request
     * @param NewsResource $newsResource
     * @param NewsFactory $newsFactory
     */
    public function __construct(
        ResultFactory $resultFactory,
        Random $random,
        ManagerInterface $messageManager,
        CommentResource $commentResource,
        CommentFactory $commentFactory,
        RequestInterface $request,
        NewsResource $newsResource,
        NewsFactory $newsFactory
    ) {
        $this->resultFactory = $resultFactory;
        $this->random = $random;
        $this->messageManager = $messageManager;
        $this->commentResource = $commentResource;
        $this->commentFactory = $commentFactory;
        $this->request = $request;
        $this->newsResource = $newsResource;
        $this->newsFactory = $newsFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);

        if (!$newsId = $this->request->getParam('id')) {
            return $resultForward->forward('noroute');
        }

        $news = $this->newsFactory->create();
        $this->newsResource->load($news, $newsId);

        if(!$news->getId()) {
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
