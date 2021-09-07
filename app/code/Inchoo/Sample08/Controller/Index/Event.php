<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\DataObject\Factory;
use Magento\Framework\Event\ManagerInterface;

class Event implements HttpGetActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var ManagerInterface
     */
    protected $eventManager;

    /**
     * @var Factory
     */
    protected $dataObjectFactory;

    /**
     * Index constructor.
     * @param ResultFactory $resultFactory
     * @param ManagerInterface $eventManager
     * @param Factory $dataObjectFactory
     */
    public function __construct(
        ResultFactory $resultFactory,
        ManagerInterface $eventManager,
        Factory $dataObjectFactory
    ) {
        $this->resultFactory = $resultFactory;
        $this->eventManager = $eventManager;
        $this->dataObjectFactory = $dataObjectFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $dataObject = $this->dataObjectFactory->create(['company' => 'Inchoo', 'city' => 'Osijek']);

        // simple event
        $this->eventManager->dispatch('custom_event');

        // event with data
        $this->eventManager->dispatch('custom_event_object', ['object' => $dataObject]);

        return $this->resultFactory->create(ResultFactory::TYPE_RAW)->setContents('Inchoo_Sample08');
    }
}
