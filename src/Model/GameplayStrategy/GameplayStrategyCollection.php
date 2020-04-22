<?php declare(strict_types=1);

namespace Game\Model\GameplayStrategy;

class GameplayStrategyCollection
{
    /**
     * @var array
     */
    private array $gameplayStrategies;

    public function __construct()
    {
        $this->gameplayStrategies = [];
    }

    public function addGameplayStrategy(GameplayStrategyInterface $gameplayStrategy): GameplayStrategyCollection
    {
        $this->gameplayStrategies[$gameplayStrategy->getName()] = $gameplayStrategy;

        return $this;
    }

    /**
     * @param string $gameplayStrategyName
     *
     * @return GameplayStrategyInterface
     */
    public function findGameplayStrategy(string $gameplayStrategyName): GameplayStrategyInterface
    {
        return $this->gameplayStrategies[$gameplayStrategyName];
    }
}
