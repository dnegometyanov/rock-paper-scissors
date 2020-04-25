<?php declare(strict_types=1);

namespace Game\Model\Player;

class PlayerCollection
{
    /**
     * @var Player[]
     */
    private array $players;

    public function __construct()
    {
        $this->players = [];
    }

    public function addPlayer(Player $playerStrategy): PlayerCollection
    {
        $this->players[] = $playerStrategy;

        return $this;
    }

    /**
     * @param string $playerName
     *
     * @return Player
     */
    public function findPlayer(string $playerName): Player
    {
        return current(array_filter($this->players, fn (Player $player) => $playerName === $player->getName()));
    }

    /**
     * @return Player[]
     */
    public function toArray(): array
    {
        return $this->players;
    }
}
