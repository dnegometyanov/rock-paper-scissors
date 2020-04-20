<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Model\MoveOption\MoveOptionInterface;
use Game\Model\Player\PlayerInterface;

class Move
{
    /**
     * @var PlayerInterface
     */
    private PlayerInterface $player;

    /**
     * @var MoveOptionInterface
     */
    private MoveOptionInterface $item;

    public function __construct(
        PlayerInterface $player,
        MoveOptionInterface $item
    )
    {
        $this->player = $player;
        $this->item   = $item;
    }

    /**
     * @return PlayerInterface
     */
    public function getPlayer(): PlayerInterface
    {
        return $this->player;
    }

    /**
     * @return MoveOptionInterface
     */
    public function getItem(): MoveOptionInterface
    {
        return $this->item;
    }
}
