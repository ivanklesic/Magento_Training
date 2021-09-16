<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Observer\Controller\Index;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

/**
 * When the dummy controller is triggered, this observer logs it in system.log
 */
class DummyObserver implements ObserverInterface
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
        $this->logger->info('dummy observer');
    }
}
