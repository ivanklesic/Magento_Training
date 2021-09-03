<?php

declare(strict_types=1);

namespace Inchoo\Sample02\Controller\Index;

use Inchoo\Sample02\Model\CompanyFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Company implements HttpGetActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var CompanyFactory
     */
    protected $companyFactory;

    /**
     * Company constructor.
     * @param ResultFactory $resultFactory
     * @param CompanyFactory $companyFactory
     */
    public function __construct(ResultFactory $resultFactory, CompanyFactory $companyFactory)
    {
        $this->resultFactory = $resultFactory;
        $this->companyFactory = $companyFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        /** @var \Inchoo\Sample02\Model\Company $company */
//        $company = $this->companyFactory->create(['data' => ['name' => 'Inchoo']]);
        $company = $this->companyFactory->create()->setName('Inchoo');

        return $resultRaw->setContents($company->getName());
    }
}
