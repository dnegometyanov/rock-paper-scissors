<?php declare(strict_types=1);

namespace Game\Model\PlayerGameScore;

use Game\Model\Move\Move;

class PlayerGameScore
{
    /**
     * @var Move
     */
    private Move $move;

    private int $score;

    public function __construct(
        Move $move,
        int $score
    )
    {
        $this->move   = $move;
        $this->score  = $score;
    }

    public function incrementScore(): void {
        $this->score++;
    }

    /**
     * @return Move
     */
    public function getMove(): Move
    {
        return $this->move;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }
}
