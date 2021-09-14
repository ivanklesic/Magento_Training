<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            'general/hello_world/enabled',
            ScopeInterface::SCOPE_STORES
        );
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->scopeConfig->getValue(
            'general/hello_world/title',
            ScopeInterface::SCOPE_STORES
        );
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->scopeConfig->getValue(
            'general/hello_world/content',
            ScopeInterface::SCOPE_STORES
        );
    }

    /**
     * @return string|null
     */
    public function getRobots(): ?string
    {
        return $this->scopeConfig->getValue(
            'catalog/seo/catalog_search_meta_robots',
            ScopeInterface::SCOPE_STORES
        );
    }


}
