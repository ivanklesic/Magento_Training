<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

/**
 * When a customer signs in, this observer logs his/her email in system.log
 */
class CustomerLoginObserver implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * CustomEventObserver constructor.
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
        $this->logger->info('customer_login observer', [
            'customer_email' => $observer->getEvent()->getData('customer')->getEmail()
        ]);
    }
}
