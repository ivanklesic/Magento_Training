<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Controller\Adminhtml\Postcode;

use Inchoo\Sample06\Model\PostcodeRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Magento_Backend::system_other_settings';

    /**
     * @var PostcodeRepository
     */
    protected $postcodeRepository;

    /**
     * Edit constructor.
     * @param PostcodeRepository $postcodeRepository
     * @param Context $context
     */
    public function __construct(
        PostcodeRepository $postcodeRepository,
        Context $context
    ) {
        $this->postcodeRepository = $postcodeRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $title = __('Postcode Form');

        /** @var \Inchoo\Sample06\Model\Postcode $postcode */
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $postcode = $this->postcodeRepository->get((int)$id);
                $title = "{$postcode->getData('code')}-{$postcode->getData('country')}";
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                $this->messageManager->addExceptionMessage($e);
                return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/grid');
            }
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Inchoo_Sample06::postcode');
        $resultPage->addBreadcrumb($title, $title);
        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }
}
