<?php declare(strict_types=1);

namespace Game\Gameplay\GameplayStrategy;

class GameplayStrategyCollection
{
    /**
     * @var GameplayStrategyInterface[]
     */
    private array $playerStrategies;

    public function __construct()
    {
        $this->playerStrategies = [];
    }

    public function addPlayerStrategy(GameplayStrategyInterface $playerStrategy): GameplayStrategyCollection
    {
        $this->playerStrategies[] = $playerStrategy;

        return $this;
    }

    /**
     * @return GameplayStrategyInterface[]
     */
    public function getPlayerStrategies(): array
    {
        return $this->playerStrategies;
    }

    /**
     * @param string $playerStrategyName
     *
     * @return GameplayStrategyInterface
     */
    public function findPlayerStrategy(string $playerStrategyName): GameplayStrategyInterface
    {
        return current(array_filter( $this->playerStrategies, fn (GameplayStrategyInterface $playerStrategy) => $playerStrategyName === $playerStrategy->getName()));
    }
}