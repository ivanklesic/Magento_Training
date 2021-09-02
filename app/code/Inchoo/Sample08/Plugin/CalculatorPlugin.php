<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Plugin;

use Inchoo\Sample08\Model\Calculator;

class CalculatorPlugin
{
    /**
     * @param Calculator $subject
     * @param int $a
     * @param int $b
     * @return int[]
     */
    public function beforeSumIntegers(Calculator $subject, int $a, int $b): array
    {
        $a *= 2; // modify the argument of an observed method
        return [$a, $b];
    }

    /**
     * @param Calculator $subject
     * @param float $result
     * @return float
     */
    public function afterMultiplyNumbers(Calculator $subject, float $result): float
    {
        return $result * 3; // modify the result of an observed method
    }

    /**
     * @param Calculator $subject
     * @param callable $proceed
     * @param float $dividend
     * @param float $divisor
     * @return float
     */
    public function aroundSubtract(Calculator $subject, callable $proceed, float $dividend, float $divisor): float
    {
        $dividend *= 4; // modify the argument of an observed method

        $result = $proceed($dividend, $divisor); // call observed method

        return $result * 5; // modify the result of an observed method
    }
}
