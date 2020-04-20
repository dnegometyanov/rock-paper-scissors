<?php declare(strict_types=1);

namespace Game\Game;

use Game\Item\ItemInterface;

class Game implements GameInterface
{
    public function __construct(
        array $players,
        array $rules
    )
    {
    }

    public function play(): ItemInterface
    {
        return $this->playerStrategy->selectItem();
    }
}