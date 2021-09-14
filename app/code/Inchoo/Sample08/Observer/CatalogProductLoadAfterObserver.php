<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

/**
 * When a product entity is loaded, this observer logs its name in system.log
 */
class CatalogProductLoadAfterObserver implements ObserverInterface
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
        $this->logger->info('catalog_product_load_after observer', [
            'product_name' => $observer->getData('product')->getName()
        ]);
    }
}
