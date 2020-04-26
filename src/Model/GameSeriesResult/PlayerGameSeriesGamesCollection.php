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
     * @param PlayerGameScoreGroupedRankedCollection $playerGameScoreGroupedRankedCollection
     *
     * @return PlayerGameSeriesGamesCollection
     */
    public function addGame(PlayerGameScoreGroupedRankedCollection $playerGameScoreGroupedRankedCollection): PlayerGameSeriesGamesCollection
    {
        $this->playersGames[] = $playerGameScoreGroupedRankedCollection;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->playersGames;
    }
}
