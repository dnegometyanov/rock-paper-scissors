<?php declare(strict_types=1);

namespace Game\Player;

use Game\Item\ItemCollection;

class PlayerCollectionFactory
{
    /**
     * @var PlayerFactory
     */
    private PlayerFactory $playerFactory;

    public function __construct(PlayerFactory $playerFactory)
    {
        $this->playerFactory = $playerFactory;
    }

    /**
     * @param array $playerConfig
     * @param PlayerStrategyCollection $playerStrategyCollection
     *
     * @return PlayerCollection
     */
    public function create(array $playerConfig, PlayerStrategyCollection $playerStrategyCollection): PlayerCollection
    {
        $playerNames = array_keys($playerConfig);
        return array_reduce(
            $playerNames,
            fn (PlayerCollection $playerCollection, string $playerName) =>
                $playerCollection->addPlayer(
                    $this->playerFactory->createPlayer(
                        $playerName,
                        $playerStrategyCollection->findPlayerStrategy($playerName),
                    )
                ),
            new PlayerCollection()
        );
    }
}