<?php

declare(strict_types=1);

namespace Inchoo\Sample01\Controller\Sub1\Sub2;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\ResultFactory;

class ListAction implements ActionInterface
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
        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        return $resultRaw->setContents('Test list controller');
    }
}
