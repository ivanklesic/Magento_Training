<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Controller\Index;

use Inchoo\Sample08\Model\Calculator;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Plugin implements HttpGetActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var Calculator
     */
    protected $calculator;

    /**
     * Plugin constructor.
     * @param ResultFactory $resultFactory
     * @param Calculator $calculator
     */
    public function __construct(ResultFactory $resultFactory, Calculator $calculator)
    {
        $this->resultFactory = $resultFactory;
        $this->calculator = $calculator;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        $resultJson->setData([
            'sum'      => $this->calculator->sumIntegers(1, 2),
            'multiply' => $this->calculator->multiplyNumbers(2, 3),
            'subtract' => $this->calculator->subtract(15, 5),
        ]);

        return $resultJson;
    }
}
