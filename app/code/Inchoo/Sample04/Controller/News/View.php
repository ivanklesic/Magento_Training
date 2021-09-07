<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Controller\News;

use Inchoo\Sample04\Model\NewsFactory;
use Inchoo\Sample04\Model\ResourceModel\News as NewsResource;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;

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
     * @var NewsResource
     */
    protected $newsResource;

    /**
     * @var NewsFactory
     */
    protected $newsFactory;

    /**
     * @var Registry
     */
    protected $registry;

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
        NewsFactory $newsFactory,
        Registry $registry
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->newsResource = $newsResource;
        $this->newsFactory = $newsFactory;
        $this->registry = $registry;
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

        $news = $this->newsFactory->create();
        $this->newsResource->load($news, $newsId);

        // non existing entity_id value means that model isn't loaded
        if (!$news->getEntityId() || !$news->getStatus()) {
            $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
            return $resultForward->forward('noroute');
        }

        // we save loaded module so we can reuse it later (we avoid redundant DB queries)
        // Registry class is deprecated but we will use it for now (service contracts solve this)
        $this->registry->register('current_news', $news);

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set($news->getTitle());

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
