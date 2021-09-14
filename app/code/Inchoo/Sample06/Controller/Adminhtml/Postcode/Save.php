<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Controller\Adminhtml\Postcode;

use Inchoo\Sample06\Model\PostcodeFactory;
use Inchoo\Sample06\Model\PostcodeRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action implements HttpPostActionInterface
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
     * @var PostcodeFactory
     */
    protected $postcodeFactory;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * Save constructor.
     * @param PostcodeRepository $postcodeRepository
     * @param PostcodeFactory $postcodeFactory
     * @param DataPersistorInterface $dataPersistor
     * @param Context $context
     */
    public function __construct(
        PostcodeRepository $postcodeRepository,
        PostcodeFactory $postcodeFactory,
        DataPersistorInterface $dataPersistor,
        Context $context
    ) {
        $this->postcodeRepository = $postcodeRepository;
        $this->postcodeFactory = $postcodeFactory;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $request = $this->getRequest();
        $id = $request->getParam('entity_id');

        if (!$this->isDataValid()) {
            $this->messageManager->addErrorMessage(__('Form data is not valid.'));
            $this->dataPersistor->set('inchoo_postcode', $request->getParams());
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }

        try {
            $postcode = $id ? $this->postcodeRepository->get((int)$id) : $this->postcodeFactory->create();
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            $this->messageManager->addExceptionMessage($e);
            return $resultRedirect->setPath('*/*/grid');
        }

        $postcode->setData('code', $request->getParam('code'));
        $postcode->setData('country', $request->getParam('country'));
        $postcode->setData('city', $request->getParam('city') ?: null);

        try {
            $this->postcodeRepository->save($postcode);
        } catch (\Magento\Framework\Exception\CouldNotSaveException $e) {
            $this->dataPersistor->set('inchoo_postcode', $request->getParams());
            $this->messageManager->addExceptionMessage($e);
        }

        return $resultRedirect->setPath('*/*/edit', ['id' => $postcode->getEntityId()]);
    }

    /**
     * @return bool
     */
    protected function isDataValid(): bool
    {
        foreach (['code', 'country'] as $requiredParam) {
            if (!$this->getRequest()->getParam($requiredParam)) {
                return false;
            }
        }

        return true;
    }
}
