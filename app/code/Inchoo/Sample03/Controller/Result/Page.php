<?php

declare(strict_types=1);

namespace Inchoo\Sample03\Controller\Result;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Page implements HttpGetActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * Page constructor.
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

        return $resultPage;
    }
}
