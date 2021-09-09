<?php

declare(strict_types=1);

namespace Inchoo\Sample03\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\StoreManagerInterface;

class Custom implements ArgumentInterface
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Custom constructor.
     * @param RequestInterface $request
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(RequestInterface $request, StoreManagerInterface $storeManager)
    {
        $this->request = $request;
        $this->storeManager = $storeManager;
    }

    /**
     * @return string|null
     */
    public function getStoreName(): ?string
    {
        try {
            return $this->storeManager->getStore()->getName();
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * @return array
     */
    public function getRequestParams(): array
    {
        return $this->request->getParams();
    }

    /**
     * @param string $key
     * @param mixed $defaultValue
     * @return mixed
     */
    public function getParamValue(string $key, $defaultValue = null)
    {
        return $this->request->getParam($key, $defaultValue);
    }
}
