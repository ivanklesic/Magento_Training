<?php

declare(strict_types=1);

namespace Inchoo\Sample02\Controller\Di;

use Inchoo\Sample02\Model\Preference\DummyInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Preference implements HttpGetActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var DummyInterface
     */
    protected $dummy;

    /**
     * Preference constructor.
     * @param ResultFactory $resultFactory
     * @param DummyInterface $dummy
     */
    public function __construct(ResultFactory $resultFactory, DummyInterface $dummy)
    {
        $this->resultFactory = $resultFactory;
        $this->dummy = $dummy;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        return $resultRaw->setContents($this->dummy->getClassName());
    }
}
