<?php declare(strict_types=1);

namespace Game\Model\Player;

use Game\Gameplay\GameplayStrategy\GameplayStrategyInterface;

class PlayerFactory
{
    public function createPlayer(string $playerName, GameplayStrategyInterface $playerStrategy): PlayerInterface
    {
        return new Player($playerName, $playerStrategy);
    }
}
