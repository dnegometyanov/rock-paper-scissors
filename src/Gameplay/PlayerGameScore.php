<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Model\MoveOption\MoveOption;
use Game\Model\Player\Player;

class PlayerGameScore
{
    /**
     * @var Player
     */
    private Player $player;

    private int $score;

    /**
     * @var MoveOption
     */
    private MoveOption $item;

    public function __construct(
        Player $player,
        int $score,
        int $rank
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

    /**
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

}
