<?php

declare(strict_types=1);

namespace Inchoo\Sample01\Controller\Params;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;

/**
 * Accepts only GET and HEAD requests.
 */
class Get implements HttpGetActionInterface
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
     * Get constructor.
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
        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        $id = $this->request->getParam('id');
        if (null === $id) {
            return $resultRaw->setHttpResponseCode(400);
        }

        if (!$company = $this->getCompanyById((int)$id)) {
            return $resultRaw->setHttpResponseCode(404);
        }

        return $resultRaw->setContents($company);
    }

    /**
     * @param int $id
     * @return string|null
     */
    protected function getCompanyById(int $id): ?string
    {
        $data = [
            1 => 'Inchoo',
            2 => 'Google',
            3 => 'Facebook',
            4 => 'Amazon'
        ];

        return $data[$id] ?? null;
    }
}
