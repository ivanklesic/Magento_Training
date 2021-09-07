<?php

declare(strict_types=1);

namespace Inchoo\Sample02\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Store\Model\StoreManagerInterface;

class LazyLoad implements HttpGetActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * LazyLoad constructor.
     * @param ResultFactory $resultFactory
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(ResultFactory $resultFactory, StoreManagerInterface $storeManager)
    {
        $this->resultFactory = $resultFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        try {
            $resultRaw->setContents($this->storeManager->getStore()->getName());
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            $resultRaw->setStatusHeader(500);
        }

        return $resultRaw;
    }
}
