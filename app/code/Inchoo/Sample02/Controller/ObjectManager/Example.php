<?php

declare(strict_types=1);

namespace Inchoo\Sample02\Controller\ObjectManager;

use Magento\Framework\App\Action\HttpGetActionInterface;

class Example implements HttpGetActionInterface
{
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // DON'T USE OBJECT MANAGER DIRECTLY, THIS IS FOR LEARNING PURPOSES
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        // get singleton object instance
        $request = $objectManager->get(\Magento\Framework\App\RequestInterface::class); // phpcs:disable

        // create new object instance
        $company = $objectManager->create(\Inchoo\Sample02\Model\Company::class); // phpcs:disable

        $companyName = $request->getParam('company', 'Inchoo');
        $company->setName((string)$companyName);

        // we use object manger to directly create Raw result instance
        $resultRaw = $objectManager->create(\Magento\Framework\Controller\Result\Raw::class); // phpcs:disable
        return $resultRaw->setContents($company->getName());
    }
}
