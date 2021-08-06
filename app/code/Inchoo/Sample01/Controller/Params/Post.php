<?php

declare(strict_types=1);

namespace Inchoo\Sample01\Controller\Params;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;

/**
 * Accepts only POST requests.
 */
class Post implements HttpPostActionInterface, CsrfAwareActionInterface
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Post constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     */
    public function __construct(ResultFactory $resultFactory, RequestInterface $request)
    {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        $company = $this->request->getParam('company', 'Inchoo');
        $resultJson->setData(['company' => $company]);

        return $resultJson;
    }

    /**
     * @param RequestInterface $request
     * @return InvalidRequestException|null
     */
    public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException
    {
        return null;
    }

    /**
     * @param RequestInterface $request
     * @return bool|null
     */
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }
}
