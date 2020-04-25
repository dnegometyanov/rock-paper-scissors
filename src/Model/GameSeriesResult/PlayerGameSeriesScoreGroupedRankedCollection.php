<?php declare(strict_types=1);

namespace Game\Model\GameSeriesResult;


class PlayerGameSeriesScoreGroupedRankedCollection
{
    /**
     * @var array
     */
    private array $gameSeriesScoreGroupedRanked;

    public function __construct(PlayerGameSeriesScoreGroupedSortedCollection $playerGameSeriesScoreGroupedRankedCollection)
    {
        $this->gameSeriesScoreGroupedRanked = array_values($playerGameSeriesScoreGroupedRankedCollection->toArray());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->gameSeriesScoreGroupedRanked;
    }
}
