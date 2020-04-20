<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Model\MoveOption\MoveOptionInterface;
use Game\Model\Player\PlayerCollection;

class Game implements GameInterface
{
    public function __construct(
        PlayerCollection $players,
        Rules $rules
    )
    {
    }

    public function play(): MoveOptionInterface
    {
        return $this->playerStrategy->selectItem();
    }
}
