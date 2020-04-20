<?php declare(strict_types=1);

namespace Game\Player;

use Game\Item\ItemCollection;

class PlayerCollectionFactory
{
    /**
     * @var PlayerFactory
     */
    private PlayerFactory $playerFactory;

    /**
     * @var PlayerStrategyFactory
     */
    private PlayerStrategyFactory $playerStrategyFactory;

    public function __construct(PlayerFactory $playerFactory, PlayerStrategyFactory $playerStrategyFactory)
    {
        $this->playerFactory         = $playerFactory;
        $this->playerStrategyFactory = $playerStrategyFactory;
    }

    /**
     * @param array $playerStrategyConfig
     * @param ItemCollection $itemCollection
     *
     * @return PlayerCollection
     */
    public function create(array $playerStrategyConfig, ItemCollection $itemCollection): PlayerCollection
    {
        $playerNames = array_keys($playerStrategyConfig);
        return array_reduce(
            $playerNames,
            fn (PlayerCollection $playerCollection, string $playerName) =>
                $playerCollection->addPlayer(
                    $this->playerFactory->createPlayer(
                        $playerName,
                        $this->playerStrategyFactory->createStrategy(
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