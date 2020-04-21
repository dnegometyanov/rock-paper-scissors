<?php declare(strict_types=1);

namespace Game\Util;

class WeightedRandom
{
    /**
     * Implementation of weighted random from
     * https://stackoverflow.com/questions/445235/generating-random-results-by-weight-in-php
     *
     * @param array $weightedValues
     *
     * @return int|mixed|string
     */
    public static function getWeightedRandomElement(array $weightedValues) {
        $rand = mt_rand(1, (int) array_sum($weightedValues));

        foreach ($weightedValues as $key => $value) {
            $rand -= $value;
            if ($rand <= 0) {
                return $key;
            }
        }

        return $rand;
    }
}
