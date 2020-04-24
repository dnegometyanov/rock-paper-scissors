<?php declare(strict_types=1);

namespace Game\Model\PlayerGameScore;


class PlayerGameScoreGroupedRankedCollection
{
    private array $gameScoreGroupedRanked;

    public function __construct(PlayerGameScoreGroupedSortedCollection $playerGameScoreGroupedSortedCollection)
    {
        $this->gameScoreGroupedRanked = array_values($playerGameScoreGroupedSortedCollection->getGameScoreGroupedSorted());
    }

    /**
     * @return array
     */
    public function getGameScoreGroupedRanked(): array
    {
        return array_values($this->gameScoreGroupedRanked);
    }
}
