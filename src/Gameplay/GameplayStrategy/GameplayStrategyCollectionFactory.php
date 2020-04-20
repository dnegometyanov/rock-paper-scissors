<?php declare(strict_types=1);

namespace Game\Gameplay\GameplayStrategy;

use Game\Model\MoveOption\MoveOptionCollection;

class GameplayStrategyCollectionFactory
{
    /**
     * @var GameplayStrategyFactory
     */
    private GameplayStrategyFactory $gameplayStrategyFactory;

    /**
     * @var MoveOptionCollection
     */
    private MoveOptionCollection $moveOptionCollection;

    public function __construct(
        GameplayStrategyFactory $gameplayStrategyFactory,
        MoveOptionCollection $moveOptionCollection
    )
    {
        $this->gameplayStrategyFactory = $gameplayStrategyFactory;
        $this->moveOptionCollection    = $moveOptionCollection;
    }

    /**
     * @param array $gameplayStrategiesConfig
     *
     * @throws \Exception
     *
     * @return GameplayStrategyCollection
     */
    public function createGameplayStrategyCollection(array $gameplayStrategiesConfig): GameplayStrategyCollection
    {
        $strategyNames = array_keys($gameplayStrategiesConfig);

        return array_reduce(
            $gameplayStrategiesConfig,
            fn(GameplayStrategyCollection $gameplayStrategyCollection, array $gameplayStrategyConfig) =>
                $gameplayStrategyCollection->addGameplayStrategy(
                    $this->gameplayStrategyFactory->createStrategy(
                        $gameplayStrategyConfig['strategy_type'],
                        $gameplayStrategyConfig['strategy_name'],
                        $gameplayStrategyConfig,
                    )
                ),
            new GameplayStrategyCollection(),
        );
    }
}
