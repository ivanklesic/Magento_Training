<?php

declare(strict_types=1);

namespace Inchoo\Sample02\Controller\di;

use Inchoo\Sample02\Model\Preference\DummyOne;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Override implements HttpGetActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var DummyOne
     */
    protected $dummyOne;

    /**
     * Override constructor.
     * @param ResultFactory $resultFactory
     * @param DummyOne $dummyOne
     */
    public function __construct(ResultFactory $resultFactory, DummyOne $dummyOne)
    {
        $this->resultFactory = $resultFactory;
        $this->dummyOne = $dummyOne;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        return $resultRaw->setContents($this->dummyOne->getClassName());
    }
}
