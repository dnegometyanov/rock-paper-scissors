<?php declare(strict_types=1);

namespace Game\Model\Player;

use Game\Gameplay\GameplayStrategy\GameplayStrategyFactory;
use Game\Model\MoveOption\MoveOptionCollection;

class PlayerCollectionFactory
{
    /**
     * @var PlayerFactory
     */
    private PlayerFactory $playerFactory;

    /**
     * @var GameplayStrategyFactory
     */
    private GameplayStrategyFactory $gameplayStrategyFactory;

    public function __construct(PlayerFactory $playerFactory, GameplayStrategyFactory $playerStrategyFactory)
    {
        $this->playerFactory           = $playerFactory;
        $this->gameplayStrategyFactory = $playerStrategyFactory;
    }

    /**
     * @param array $playerStrategyConfig
     * @param MoveOptionCollection $itemCollection
     *
     * @return PlayerCollection
     */
    public function create(array $playerStrategyConfig, MoveOptionCollection $itemCollection): PlayerCollection
    {
        $playerNames = array_keys($playerStrategyConfig);

        return array_reduce(
            $playerNames,
            fn (PlayerCollection $playerCollection, string $playerName) =>
                $playerCollection->addPlayer(
                    $this->playerFactory->createPlayer(
                        $playerName,
                        $this->gameplayStrategyFactory->createStrategy(
                            $playerStrategyConfig[$playerName]['strategy_name'],
                            $itemCollection,
                            $playerStrategyConfig[$playerName]['strategy_config'],
                        )
                    )
                ),
            new PlayerCollection()
        );
    }
}