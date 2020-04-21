<?php declare(strict_types=1);

namespace Game\Model\PlayerGameScore;

use Game\Model\Player\Player;

class PlayerGameScore
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

    public function incrementScore(): void {
        $this->score++;
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
