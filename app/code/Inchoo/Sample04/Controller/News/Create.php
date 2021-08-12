<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Controller\News;

use Inchoo\Sample04\Model\NewsFactory;
use Inchoo\Sample04\Model\ResourceModel\News as NewsResource;
use Magento\Framework\App\Action\HttpGetActionInterface;
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
     * @var NewsResource
     */
    protected $newsResource;

    /**
     * @var NewsFactory
     */
    protected $newsFactory;

    /**
     * Create constructor.
     * @param ResultFactory $resultFactory
     * @param Random $random
     * @param ManagerInterface $messageManager
     * @param NewsResource $newsResource
     * @param NewsFactory $newsFactory
     */
    public function __construct(
        ResultFactory $resultFactory,
        Random $random,
        ManagerInterface $messageManager,
        NewsResource $newsResource,
        NewsFactory $newsFactory
    ) {
        $this->resultFactory = $resultFactory;
        $this->random = $random;
        $this->messageManager = $messageManager;
        $this->newsResource = $newsResource;
        $this->newsFactory = $newsFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/list');

        try {
            $randomTitle = $this->random->getRandomString(8);
            $randomContent = $this->random->getRandomString(64);
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addErrorMessage(__('Could not create a random string.'));
            return $resultRedirect;
        }

        $news = $this->newsFactory->create();
        $news->setTitle($randomTitle);
        $news->setStatus(1);
        $news->setContent($randomContent);

        try {
            $this->newsResource->save($news);
            $this->messageManager->addSuccessMessage(__('%1 successfully created!', $news->getTitle()));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $resultRedirect;
        }

        return $resultRedirect;
    }
}
