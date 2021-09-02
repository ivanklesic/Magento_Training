<?php

declare(strict_types=1);

namespace Inchoo\Sample07\Model\Source\Attribute;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Season extends AbstractSource
{
    public const VALUE_SPRING = 1;
    public const VALUE_SUMMER = 2;
    public const VALUE_AUTUMN = 3;
    public const VALUE_WINTER = 4;

    /**
     * @return array
     */
    public function getAllOptions()
    {
        if (null === $this->_options) {
            $this->_options = [
                ['label' => __('Spring'), 'value' => self::VALUE_SPRING],
                ['label' => __('Summer'), 'value' => self::VALUE_SUMMER],
                ['label' => __('Autumn'), 'value' => self::VALUE_AUTUMN],
                ['label' => __('Winter'), 'value' => self::VALUE_WINTER]
            ];
        }
        return $this->_options;
    }
}
