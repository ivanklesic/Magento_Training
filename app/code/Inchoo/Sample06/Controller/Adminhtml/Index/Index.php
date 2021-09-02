<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Inchoo_Sample06::hello_world';

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Inchoo_Sample06::hello_world');
        $resultPage->addBreadcrumb(__('Hello World'), __('Hello World'));
        $resultPage->getConfig()->getTitle()->prepend(__('Hello World'));

        return $resultPage;
    }
}
