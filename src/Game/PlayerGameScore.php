<?php declare(strict_types=1);

namespace Game\Game;

use Game\Item\ItemInterface;
use Game\Player\PlayerInterface;

class PlayerGameScore
{
    /**
     * @var PlayerInterface
     */
    private PlayerInterface $player;

    private int $score;

    private int $rank;

    /**
     * @var ItemInterface
     */
    private ItemInterface $item;

    public function __construct(
        PlayerInterface $player,
        int $score,
        int $rank
    )
    {
        $this->player = $player;
        $this->score  = $score;
        $this->score  = $rank;
    }

    public function victory(): void {
        $this->score++;
        $this->rank--;
    }

    /**
     * @return PlayerInterface
     */
    public function getPlayer(): PlayerInterface
    {
        return $this->player;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

}