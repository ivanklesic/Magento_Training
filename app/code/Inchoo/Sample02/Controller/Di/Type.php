<?php

declare(strict_types=1);

namespace Inchoo\Sample02\Controller\Di;

use Inchoo\Sample02\Model\Sample;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Type implements HttpGetActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var Sample
     */
    protected $sample;

    /**
     * Type constructor.
     * @param ResultFactory $resultFactory
     * @param Sample $sample
     */
    public function __construct(ResultFactory $resultFactory, Sample $sample)
    {
        $this->resultFactory = $resultFactory;
        $this->sample = $sample;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        return $resultRaw->setContents($this->sample->getSerializedString());
    }
}
