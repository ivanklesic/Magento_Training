<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Controller\Adminhtml\Postcode;

use Inchoo\Sample06\Model\PostcodeRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Inchoo_Sample06::postcode';

    /**
     * @var PostcodeRepository
     */
    protected $postcodeRepository;

    /**
     * Delete constructor.
     * @param PostcodeRepository $postcodeRepository
     * @param Context $context
     */
    public function __construct(PostcodeRepository $postcodeRepository, Context $context)
    {
        $this->postcodeRepository = $postcodeRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/grid');

        if (!$id = $this->getRequest()->getParam('id')) {
            $this->messageManager->addErrorMessage(__('Wrong postcode id.'));
            return $resultRedirect;
        }

        try {
            $this->postcodeRepository->deleteById((int)$id);
            $this->messageManager->addSuccessMessage(__('Postcode successfully deleted.'));
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultRedirect;
    }
}
