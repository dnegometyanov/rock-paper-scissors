<?php declare(strict_types=1);

namespace Game\Model\GameSeriesResult;

use Game\Model\PlayerGameScore\PlayerGameScoreGroupedRankedCollection;

class PlayerGameSeriesGamesCollection
{
    /**
     * @var PlayerGameSeriesScore[]
     */
    private array $playersGames;

    public function __construct()
    {
        $this->playersGames = [];
    }

    /**
     * @param PlayerGameScoreGroupedRankedCollection $playerGameSeriesGamesCollection
     *
     * @return PlayerGameSeriesGamesCollection
     */
    public function addGame(PlayerGameScoreGroupedRankedCollection $playerGameSeriesGamesCollection): PlayerGameSeriesGamesCollection
    {
        $this->playersGames[] = $playerGameSeriesGamesCollection;

        return $this;
    }

    /**
     * @return array
     */
    public function getGames(): array
    {
        return $this->playersGames;
    }
}
