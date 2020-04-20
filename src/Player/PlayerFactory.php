<?php declare(strict_types=1);

namespace Game\Player;

class PlayerFactory
{
    public function createPlayer(string $playerName, PlayerStrategyInterface $playerStrategy): PlayerInterface
    {
        return new Player($playerName, $playerStrategy);
    }
}