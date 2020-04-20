<?php declare(strict_types=1);

namespace Game\Player;

use Game\Item\ItemCollection;

class PlayerStrategyCollectionFactory
{
    /**
     * @var PlayerStrategyFactory
     */
    private PlayerStrategyFactory $playerStrategyFactory;

    public function __construct(PlayerStrategyFactory $playerStrategyFactory)
    {
        $this->playerStrategyFactory = $playerStrategyFactory;
    }

    /**
     * @param array $playerStrategyConfig
     * @param ItemCollection $itemCollection
     *
     * @return PlayerStrategyCollection
     */
    public function create(array $playerStrategyConfig, ItemCollection $itemCollection): PlayerStrategyCollection
    {
        $playerStrategyNames = array_keys($playerStrategyConfig);
        return array_reduce(
            $playerStrategyNames,
            fn (PlayerStrategyCollection $playerStrategyCollection, string $playerStrategyName) =>
                $playerStrategyCollection->addPlayerStrategy(
                    $this->playerStrategyFactory->createStrategy(
                        $playerStrategyConfig[$playerStrategyName]['strategy_name'],
                        $itemCollection,
                        $playerStrategyConfig[$playerStrategyName]['strategy_config'],
                    )
                ),
            new PlayerStrategyCollection()
        );
    }
}