<?php declare(strict_types=1);

namespace Game\Model\Player;

class PlayerCollectionFactory
{
    /**
     * @param array $playerNames
     *
     * @return PlayerCollection
     */
    public function create(array $playerNames): PlayerCollection
    {
        return array_reduce(
            $playerNames,
            fn (PlayerCollection $playerCollection, string $playerName) => $playerCollection->addPlayer(new Player($playerName)),
            new PlayerCollection()
        );
    }
}
