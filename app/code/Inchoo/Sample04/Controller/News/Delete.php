<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Controller\News;

use Inchoo\Sample04\Model\NewsFactory;
use Inchoo\Sample04\Model\ResourceModel\News as NewsResource;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;
use Magento\Framework\Controller\Result\Redirect;

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
     * View constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param NewsResource $newsResource
     * @param NewsFactory $newsFactory
     * @param Registry $registry
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        NewsResource $newsResource,
        NewsFactory $newsFactory
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->newsResource = $newsResource;
        $this->newsFactory = $newsFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        if (!$newsId = $this->request->getParam('id')) {
            $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
            return $resultForward->forward('noroute');
        }

        $news = $this->newsFactory->create();
        $news->setId($newsId);
        $this->newsResource->delete($news);

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('sample04/news/list');
    }
}

