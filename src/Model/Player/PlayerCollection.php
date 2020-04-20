<?php declare(strict_types=1);

namespace Game\Model\Player;

class PlayerCollection
{
    /**
     * @var PlayerInterface[]
     */
    private array $players;

    public function __construct()
    {
        $this->players = [];
    }

    public function addPlayer(PlayerInterface $playerStrategy): PlayerCollection
    {
        $this->players[] = $playerStrategy;

        return $this;
    }

    /**
     * @return PlayerInterface[]
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @param string $playerName
     *
     * @return PlayerInterface
     */
    public function findPlayer(string $playerName): PlayerInterface
    {
        return current(array_filter( $this->players, fn (PlayerInterface $player) => $playerName === $player->getName()));
    }
}