<?php declare(strict_types=1);

namespace Game\Model\GameSeriesResult;

use Game\Model\Player\Player;

class PlayerGameSeriesScore
{
    /**
     * @var Player
     */
    private Player $player;

    private int $score;

    public function __construct(
        Player $player,
        int $score
    )
    {
        $this->player = $player;
        $this->score  = $score;
    }

    public function addScore(int $score): void
    {
        $this->score += $score;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
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
}
