<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Model\MoveOption\MoveOption;
use Game\Model\Player\PlayerCollection;

class Game implements GameInterface
{
    public function __construct(
        PlayerCollection $players,
        Rules $rules
    )
    {
    }

    public function play(): MoveOption
    {
        return $this->playerStrategy->selectItem();
    }
}
