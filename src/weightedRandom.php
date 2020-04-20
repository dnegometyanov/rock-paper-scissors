<?php declare(strict_types=1);

namespace Sample;

use Game\Util\WeightedRandom;

require 'vendor/autoload.php';

$weightedRandom = new WeightedRandom();

for ($i = 1; $i < 100; $i++) {
    var_dump(
        $weightedRandom->getWeightedRandomElement([
            'rock'     => 5,
            'paper'    => 10,
            'scissors' => 2,
        ])
    );
}
