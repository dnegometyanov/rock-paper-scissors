<?php declare(strict_types=1);

namespace Game\Model\GameSeriesResult;


class GameSeriesResult
{
    /**
     * @var PlayerGameSeriesScoreCollection
     */
    private PlayerGameSeriesScoreCollection $playerGameSeriesScoreCollection;

    /**
     * @var PlayerGameSeriesGamesCollection
     */
    private PlayerGameSeriesGamesCollection $playerGameSeriesGamesCollection;

    public function __construct(
        PlayerGameSeriesScoreCollection $playerGameSeriesScoreCollection,
        PlayerGameSeriesGamesCollection $playerGameSeriesGamesCollection
    )
    {
        $this->playerGameSeriesScoreCollection = $playerGameSeriesScoreCollection;
        $this->playerGameSeriesGamesCollection = $playerGameSeriesGamesCollection;
    }

    public function getPlayerGameSeriesScoreCollection(): PlayerGameSeriesScoreCollection
    {
        return $this->playerGameSeriesScoreCollection;
    }

    public function getPlayerGameSeriesGamesCollection(): PlayerGameSeriesGamesCollection
    {
        return $this->playerGameSeriesGamesCollection;
    }
}
