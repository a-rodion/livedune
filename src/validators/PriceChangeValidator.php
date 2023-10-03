<?php
declare(strict_types=1);

namespace app\validators;

use DomainException;
use RuntimeException;

class PriceChangeValidator implements Divergention
{
    protected float $deviationThreshold;
    protected float $deviation;

    /**
     * @param float $deviationThreshold
     */
    public function __construct(float $deviationThreshold)
    {
        if ($deviationThreshold < 0) {
            throw new DomainException('Deviation should be greater or equal 0');
        }
        $this->deviationThreshold = $deviationThreshold;
    }

    /**
     * @param float $current
     * @param float $new
     *
     * @return bool
     */
    public function isValidChange(float $current, float $new): bool
    {
        $diff = abs($new - $current);
        if ($current !== 0.00) {
            $this->deviation = ($diff / $current) * 100;
        } else {
            $this->deviation = 100;
        }

        return ($this->deviation <= $this->deviationThreshold);
    }

    /**
     * @throws RuntimeException
     * @return float
     */
    public function getDeviation(): float
    {
        if ($this->deviation === null) {
            throw new RuntimeException('Deviation value is not set');
        }
        return $this->deviation;
    }
}
