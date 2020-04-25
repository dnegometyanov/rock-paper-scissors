<?php declare(strict_types=1);

namespace Game\Model\GameSeriesResult;


class GameSeriesResult
{
    /**
     * @var PlayerGameSeriesScoreGroupedRankedCollection
     */
    private PlayerGameSeriesScoreGroupedRankedCollection $playerGameSeriesScoreGroupedRankedCollection;

    /**
     * @var PlayerGameSeriesGamesCollection
     */
    private PlayerGameSeriesGamesCollection $playerGameSeriesGamesCollection;

    public function __construct(
        PlayerGameSeriesScoreGroupedRankedCollection $playerGameSeriesScoreGroupedRankedCollection,
        PlayerGameSeriesGamesCollection $playerGameSeriesGamesCollection
    )
    {
        $this->playerGameSeriesScoreGroupedRankedCollection = $playerGameSeriesScoreGroupedRankedCollection;
        $this->playerGameSeriesGamesCollection              = $playerGameSeriesGamesCollection;
    }

    public function toArray(): PlayerGameSeriesScoreGroupedRankedCollection
    {
        return $this->playerGameSeriesScoreGroupedRankedCollection;
    }
}
