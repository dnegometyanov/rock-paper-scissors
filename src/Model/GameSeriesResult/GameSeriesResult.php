<?php declare(strict_types=1);

namespace Game\Model\GameSeriesResult;

use Game\Model\PlayerGameScore\PlayerGameScoreGroupedRankedCollection;

class GameSeriesResult
{
    /**
     * @var PlayerGameSeriesScore
     */
    private PlayerGameSeriesScore $playerGameSeriesScore;

    /**
     * @var PlayerGameScoreGroupedRankedCollection
     */
    private PlayerGameScoreGroupedRankedCollection $playerGameScoreGroupedRankedCollection;

    public function __construct(
        PlayerGameSeriesScore $playerGameSeriesScore,
        PlayerGameScoreGroupedRankedCollection $playerGameScoreGroupedRankedCollection
    )
    {
        $this->playerGameSeriesScore                  = $playerGameSeriesScore;
        $this->playerGameScoreGroupedRankedCollection = $playerGameScoreGroupedRankedCollection;
    }

    public function getPlayerGameSeriesScore(): PlayerGameSeriesScore
    {
        return $this->playerGameSeriesScore;
    }

    public function getPlayerGameScoreGroupedRankedCollection(): PlayerGameScoreGroupedRankedCollection
    {
        return $this->playerGameScoreGroupedRankedCollection;
    }
}
