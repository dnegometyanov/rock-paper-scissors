<?php declare(strict_types=1);

namespace Game\Model\GameRank;

use Game\Model\PlayerGameScore\PlayerGameScore;

class GameRank
{
    private array $gameRank;

    private int $score;

    public function __construct()
    {
        $this->gameRank = [];
    }

    public function rankPlayerGameScore(PlayerGameScore $playerGameScore): void {
        $this->score++;
    }
}
