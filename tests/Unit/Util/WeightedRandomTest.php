<?php declare(strict_types=1);

namespace GameTest\Unit\Util;

use Game\Util\WeightedRandom;
use PHPUnit\Framework\TestCase;

/**
 * Class InvestmentTest
 */
class WeightedRandomTest extends TestCase
{
    public function testWeightedRandom(): void
    {
        $weightedRandom = new WeightedRandom();

        var_dump($weightedRandom::getWeightedRandomElement([
            'rock'     => 1,
            'paper'    => '10',
            'scissors' => '2',
        ])
        );

        $this->assertEquals('Hello World', $weightedRandom->getWeightedRandomElement());
    }
}