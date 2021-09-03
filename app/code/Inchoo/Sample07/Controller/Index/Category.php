<?php

declare(strict_types=1);

namespace Inchoo\Sample07\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Category implements HttpGetActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * Category constructor.
     * @param ResultFactory $resultFactory
     */
    public function __construct(ResultFactory $resultFactory)
    {
        $this->resultFactory = $resultFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set(__('Category Attributes'));

        return $resultPage;
    }
}
