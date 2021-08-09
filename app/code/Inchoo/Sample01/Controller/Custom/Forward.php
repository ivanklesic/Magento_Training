<?php

declare(strict_types=1);

namespace Inchoo\Sample01\Controller\Custom;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\ResultFactory;

/**
 * Forwards to index controller
 */
class Forward implements ActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * Index constructor.
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
        /** @var \Magento\Framework\Controller\Result\Forward $resultForward */
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);

        $resultForward->setController('index');
        return $resultForward->forward('index');
    }
}
