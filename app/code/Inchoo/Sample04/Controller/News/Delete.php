<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Controller\News;

use Inchoo\Sample04\Model\NewsFactory;
use Inchoo\Sample04\Model\ResourceModel\News as NewsResource;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;
use Magento\Framework\Controller\Result\Redirect;
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
     * @var NewsResource
     */
    protected $newsResource;

    /**
     * @var NewsFactory
     */
    protected $newsFactory;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * View constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param NewsResource $newsResource
     * @param NewsFactory $newsFactory
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        NewsResource $newsResource,
        NewsFactory $newsFactory,
        ManagerInterface $messageManager
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->newsResource = $newsResource;
        $this->newsFactory = $newsFactory;
        $this->messageManager = $messageManager;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        if (!$newsId = $this->request->getParam('id')) {
            return $resultForward->forward('noroute');
        }

        $news = $this->newsFactory->create();
        $this->newsResource->load($news, $newsId);

        if (!$news->getId()) {
            return $resultForward->forward('noroute');
        }

        try {
            $this->newsResource->delete($news);
        } catch (Exception $exception) {
            $this->messageManager->addErrorMessage(__('Could not delete news.'));
        }

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('sample04/news/list');
    }
}

