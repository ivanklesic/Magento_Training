<?php

declare(strict_types=1);

namespace Inchoo\Sample03\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Weight implements ActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * Weight constructor.
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
        $resultPage->getConfig()->getTitle()->set(__('Weight Unit List'));

//        $block = $resultPage->getLayout()->getBlock('content'); zasto je block == false

        return $resultPage;
    }
}
