<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Model\MoveOption\MoveOptionInterface;
use Game\Model\Player\PlayerInterface;

class PlayerGameScore
{
    /**
     * @var PlayerInterface
     */
    private PlayerInterface $player;

    private int $score;

    /**
     * @var MoveOptionInterface
     */
    private MoveOptionInterface $item;

    public function __construct(
        PlayerInterface $player,
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
