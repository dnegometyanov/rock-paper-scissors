<?php declare(strict_types=1);

namespace Game\Model\PlayerGameScore;


class PlayerGameScoreGroupedRankedCollection
{
    /**
     * @var array
     */
    private array $gameScoreGroupedRanked;

    public function __construct(PlayerGameScoreGroupedSortedCollection $playerGameScoreGroupedSortedCollection)
    {
        $this->gameScoreGroupedRanked = array_values($playerGameScoreGroupedSortedCollection->toArray());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->gameScoreGroupedRanked;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return count($this->gameScoreGroupedRanked);
    }
}
