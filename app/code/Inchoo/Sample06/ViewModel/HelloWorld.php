<?php

declare(strict_types=1);

namespace Inchoo\Sample06\ViewModel;

use Inchoo\Sample06\Model\Config;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class HelloWorld implements ArgumentInterface
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * HelloWorld constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->config->getTitle() ?: 'Default Title';
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->config->getContent() ?: 'Default Content';
    }

    /**
     * @return string
     */
    public function getRobots(): string
    {
        return $this->config->getRobots() ?: 'NOINDEX,FOLLOW';
    }
}
