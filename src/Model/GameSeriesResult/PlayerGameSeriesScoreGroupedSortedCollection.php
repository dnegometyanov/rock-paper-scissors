<?php declare(strict_types=1);

namespace Game\Model\GameSeriesResult;

class PlayerGameSeriesScoreGroupedSortedCollection
{
    /**
     * @var array
     */
    private array $gameSeriesScoreGroupedSorted;

    public function __construct()
    {
        $this->gameSeriesScoreGroupedSorted = [];
    }

    /**
     * @param PlayerGameSeriesScore $playerGameSeriesScore
     *
     * @return PlayerGameSeriesScoreGroupedSortedCollection
     */
    public function addPlayerGameSeriesScore(PlayerGameSeriesScore $playerGameSeriesScore): PlayerGameSeriesScoreGroupedSortedCollection
    {
        $this->gameSeriesScoreGroupedSorted[$playerGameSeriesScore->getScore()][] = $playerGameSeriesScore;

        krsort($this->gameSeriesScoreGroupedSorted);

        return $this;
    }

    public function toArray(): array
    {
        return $this->gameSeriesScoreGroupedSorted;
    }
}
