<?php declare(strict_types=1);

namespace Game\Model\PlayerGameScore;

use Game\Model\MoveOption\MoveOption;

class PlayerGameScoreGroupedSortedCollection
{
    /**
     * @var array
     */
    private array $gameScoreGroupedSorted;

    public function __construct()
    {
        $this->gameScoreGroupedSorted = [];
    }

    /**
     * @var MoveOption
     */
    private MoveOption $item;

    /**
     * @param PlayerGameScore $playerGameScore
     *
     * @return $this
     */
    public function addPlayerGameScore(PlayerGameScore $playerGameScore): PlayerGameScoreGroupedSortedCollection
    {
        $this->gameScoreGroupedSorted[$playerGameScore->getScore()][] = $playerGameScore;

        krsort($this->gameScoreGroupedSorted);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_values($this->gameScoreGroupedSorted);
    }
}
