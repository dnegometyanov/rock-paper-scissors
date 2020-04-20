<?php declare(strict_types=1);

namespace Game\Gameplay\GameplayStrategy;

use Game\Model\MoveOption\MoveOptionCollection;
use Game\Model\Player\ProbabilityGameplayStrategy;

class GameplayStrategyFactory
{
    /**
     * @param string $strategyName
     * @param MoveOptionCollection $itemCollection
     * @param array $strategyConfig
     *
     * @return GameplayStrategyInterface
     * @throws \Exception
     */
    public function createStrategy(string $strategyName, MoveOptionCollection $itemCollection, array $strategyConfig): GameplayStrategyInterface
    {
        switch ($strategyName) {
            case ProbabilityGameplayStrategy::getName():
                return new ProbabilityGameplayStrategy($itemCollection, $strategyConfig);
                break;
            default:
                throw new \Exception(sprintf('Strategy %s not found', $strategyName)); // TODO custom exception
        }
    }
}