<?php

declare(strict_types=1);

namespace Inchoo\Sample03\Block;

use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Custom extends Template
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * Custom constructor.
     * @param Session $customerSession
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Session $customerSession,
        Context $context,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getLoremIpsumString(): string
    {
        return 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.';
    }

    /**
     * @return string|null
     */
    public function getCustomerName(): ?string
    {
        if (!$this->customerSession->isLoggedIn()) {
            return null;
        }

        try {
            $customerName = $this->customerSession->getCustomer()->getName();
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $customerName = null;
        }

        return $customerName;
    }
}
