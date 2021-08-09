<?php

declare(strict_types=1);

namespace Inchoo\Sample01\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Old deprecated controller
 */
class Old extends Action
{
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        return $resultRaw->setContents('Deprecated inheritance controller');
    }
}
