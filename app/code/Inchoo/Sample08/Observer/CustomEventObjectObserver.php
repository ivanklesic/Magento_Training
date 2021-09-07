<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class CustomEventObjectObserver implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * CustomEventObjectObserver constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\DataObject $object */
        $object = $observer->getEvent()->getData('object');

        $this->logger->info('custom_event_object observer', [
            'company' => $object->getData('company'),
            'city'    => $object->getData('city')
        ]);
    }
}
