<?php declare(strict_types=1);

namespace Game\Model\PlayerGameScore;

use Game\Model\MoveOption\MoveOption;

class PlayerGameScoreGroupedSortedCollection
{
    private array $gameScoreGroupedSorted;

    public function __construct()
    {
        $this->gameScoreGroupedSorted = [];
    }

    /**
     * @var MoveOption
     */
    private MoveOption $item;

    public function addPlayerGameScore(PlayerGameScore $playerGameScore): PlayerGameScoreGroupedSortedCollection
    {
        $this->gameScoreGroupedSorted[$playerGameScore->getScore()][] = $playerGameScore;

        krsort($this->gameScoreGroupedSorted);

        return $this;
    }

    /**
     * @return array
     */
    public function getGameScoreGroupedSorted(): array
    {
        return array_values($this->gameScoreGroupedSorted);
    }
}
