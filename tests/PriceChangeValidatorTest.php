<?php
declare(strict_types=1);

use app\validators\PriceChangeValidator;
use PHPUnit\Framework\TestCase;

class PriceChangeValidatorTest extends TestCase
{
    /**
     * @covers \app\validators\PriceChangeValidator::isValidChange
     * @dataProvider dataProvider
     */
    public function testIsValidChange($threshold, $current, $new, $isValid): void
    {
        $validator = new PriceChangeValidator($threshold);
        $result = $validator->isValidChange($current, $new);

        $this->assertSame($result, $isValid);
    }

    /**
     * @return array[]
     */
    public function dataProvider(): array
    {
        // threshold, current, new, isValid
        return [
            [10, 100, 110, true],
            [10, 200, 180, true],
            [0, 100, 100, true],

            [5, 100, 94.99, false],
            [5, 100, 105.01, false],
            [0, 100, 100.01, false],
        ];
    }
}
