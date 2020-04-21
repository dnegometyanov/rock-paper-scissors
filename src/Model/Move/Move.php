<?php declare(strict_types=1);

namespace Game\Model\Move;

use Game\Model\MoveOption\MoveOption;
use Game\Model\Player\Player;

class Move
{
    /**
     * @var Player
     */
    private Player $player;

    /**
     * @var MoveOption
     */
    private MoveOption $moveOption;

    public function __construct(
        Player $player,
        MoveOption $item
    )
    {
        $this->player       = $player;
        $this->moveOption   = $item;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @return MoveOption
     */
    public function getMoveOption(): MoveOption
    {
        return $this->moveOption;
    }
}
