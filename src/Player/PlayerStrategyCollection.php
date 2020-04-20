<?php declare(strict_types=1);

namespace Game\Player;

class PlayerStrategyCollection
{
    /**
     * @var PlayerStrategyInterface[]
     */
    private array $playerStrategies;

    public function __construct()
    {
        $this->playerStrategies = [];
    }

    public function addPlayerStrategy(PlayerStrategyInterface $playerStrategy): PlayerStrategyCollection
    {
        $this->playerStrategies[] = $playerStrategy;

        return $this;
    }

    /**
     * @return PlayerStrategyInterface[]
     */
    public function getPlayerStrategies(): array
    {
        return $this->playerStrategies;
    }

    /**
     * @param string $playerStrategyName
     *
     * @return PlayerStrategyInterface
     */
    public function findPlayerStrategy(string $playerStrategyName): PlayerStrategyInterface
    {
        return current(array_filter( $this->playerStrategies, fn (PlayerStrategyInterface $playerStrategy) => $playerStrategyName === $playerStrategy->getName()));
    }
}