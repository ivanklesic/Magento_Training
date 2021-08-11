<?php

declare(strict_types=1);

namespace Inchoo\Sample03\ViewModel;

use Magento\Directory\Model\Config\Source\WeightUnit;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * A view-model class that gets data from WeightUnit and passes it to weight.phtml
 */
class Weight implements ArgumentInterface
{
    /**
     * @var WeightUnit
     */
    protected $weightUnit;

    /**
     * Custom constructor.
     * @param WeightUnit $weightUnit
     */
    public function __construct(WeightUnit $weightUnit)
    {
        $this->weightUnit = $weightUnit;
    }

    public function getWeightUnits()
    {
        return $this->weightUnit->toOptionArray();
    }
}
