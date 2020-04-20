<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Gameplay\GameplayStrategy\GameplayStrategyCollection;
use Game\Model\Player\Player;
use Game\Model\Player\PlayerCollection;

class PlayerGameplayStrategyCollectionFactory
{
    /**
     * @var PlayerCollection
     */
    private PlayerCollection $playerCollection;

    /**
     * @var GameplayStrategyCollection
     */
    private GameplayStrategyCollection $gameplayStrategyCollection;

    /**
     * @var array
     */
    private array $playerStrategiesConfig;

    public function __construct(PlayerCollection $playerCollection, GameplayStrategyCollection $gameplayStrategyCollection, array $playerStrategiesConfig)
    {
        $this->playerCollection           = $playerCollection;
        $this->gameplayStrategyCollection = $gameplayStrategyCollection;
        $this->playerStrategiesConfig     = $playerStrategiesConfig;
    }

    /**
     * @return PlayerGameplayStrategyCollection
     */
    public function createPlayerGameplayStrategyCollection(): PlayerGameplayStrategyCollection
    {
        return array_reduce(
            $this->playerCollection->getPlayers(),
            fn(PlayerGameplayStrategyCollection $playerGameplayStrategyCollection, Player $player) =>
            $playerGameplayStrategyCollection->addPlayerGameplayStrategy(
                new PlayerGameplayStrategy(
                    $player,
                    $this->gameplayStrategyCollection->findGameplayStrategy(
                        $this->playerStrategiesConfig[$player->getName()]
                    ),
                )
            ),
            new PlayerGameplayStrategyCollection(),
        );
    }
}
