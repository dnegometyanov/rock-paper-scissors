<?php declare(strict_types=1);

namespace Game\Game;

use Game\Item\ItemInterface;
use Game\Player\PlayerInterface;

class Move
{
    /**
     * @var PlayerInterface
     */
    private PlayerInterface $player;

    /**
     * @var ItemInterface
     */
    private ItemInterface $item;

    public function __construct(
        PlayerInterface $player,
        ItemInterface $item
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
     * @return ItemInterface
     */
    public function getItem(): ItemInterface
    {
        return $this->item;
    }
}