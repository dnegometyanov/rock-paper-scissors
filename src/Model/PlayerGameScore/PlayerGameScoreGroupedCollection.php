<?php declare(strict_types=1);

namespace Game\Model\PlayerGameScore;

use Game\Model\MoveOption\MoveOption;

class PlayerGameScoreGroupedCollection
{
    private array $gameScoreGrouped;

    public function __construct()
    {
        $this->gameScoreGrouped = [];
    }

    /**
     * @var MoveOption
     */
    private MoveOption $item;

    public function addPlayerGameScore(PlayerGameScore $playerGameScore): PlayerGameScoreGroupedCollection
    {
        $this->gameScoreGrouped[$playerGameScore->getScore()] = $playerGameScore;

        return $this;
    }

    /**
     * @return array
     */
    public function getGameScoreGrouped(): array
    {
        return array_values($this->gameScoreGrouped);
    }
}
