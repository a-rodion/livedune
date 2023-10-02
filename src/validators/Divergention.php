<?php
declare(strict_types=1);

namespace app\validators;

use RuntimeException;

interface Divergention
{
    /**
     * @param float $current
     * @param float $new
     *
     * @return bool
     */
    public function isValidChange(float $current, float $new): bool;

    /**
     * @throws RuntimeException
     * @return float
     */
    public function getDeviation(): float;
}
