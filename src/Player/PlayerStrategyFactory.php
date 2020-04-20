<?php declare(strict_types=1);

namespace Game\Player;

use Game\Item\ItemCollection;

class PlayerStrategyFactory
{
    /**
     * @param string $strategyName
     * @param ItemCollection $itemCollection
     * @param array $strategyConfig
     *
     * @return PlayerStrategyInterface
     * @throws \Exception
     */
    public function createStrategy(string $strategyName, ItemCollection $itemCollection, array $strategyConfig): PlayerStrategyInterface
    {
        switch ($strategyName) {
            case ProbabilityPlayerStrategy::getName():
                return new ProbabilityPlayerStrategy($itemCollection, $strategyConfig);
                break;
            default:
                throw new \Exception(sprintf('Strategy %s not found', $strategyName)); // TODO custom exception
        }
    }
}