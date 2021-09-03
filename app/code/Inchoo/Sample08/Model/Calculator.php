<?php

declare(strict_types=1);

namespace Inchoo\Sample08\Model;

class Calculator
{
    /**
     * @param int $a
     * @param int $b
     * @return int
     */
    public function sumIntegers(int $a, int $b): int
    {
        return $a + $b;
    }

    /**
     * @param float $x
     * @param float $y
     * @return float
     */
    public function multiplyNumbers(float $x, float $y): float
    {
        return $x * $y;
    }

    /**
     * @param float $dividend
     * @param float $divisor
     * @return float
     */
    public function subtract(float $dividend, float $divisor): float
    {
        return $dividend / $divisor;
    }
}
