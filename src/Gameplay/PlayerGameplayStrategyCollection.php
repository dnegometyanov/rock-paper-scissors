<?php declare(strict_types=1);

namespace Game\Gameplay;

class PlayerGameplayStrategyCollection
{
    /**
     * @var array
     */
    private array $playerGameplayStrategies;

    public function __construct()
    {
        $this->playerGameplayStrategies = [];
    }

    /**
     * @param PlayerGameplayStrategy $playerGameplayStrategy
     *
     * @return $this
     */
    public function addPlayerGameplayStrategy(PlayerGameplayStrategy $playerGameplayStrategy): PlayerGameplayStrategyCollection
    {
        $this->playerGameplayStrategies[$playerGameplayStrategy->getPlayer()->getName()] = $playerGameplayStrategy;

        return $this;
    }

    /**
     * @return PlayerGameplayStrategy[]
     */
    public function getPlayerGameplayStrategies(): array
    {
        return $this->playerGameplayStrategies;
    }

    /**
     * @param string $playerName
     *
     * @return MoveOption
     */
    public function findPlayerGameplayStrategy(string $playerName): MoveOption
    {
        return $this->playerGameplayStrategies[$playerName];
    }
}
