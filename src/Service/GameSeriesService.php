<?php declare(strict_types=1);

namespace Game\Service;

use Game\Model\GameSeriesResult\GameSeriesResult;
use Game\Model\GameSeriesResult\PlayerGameSeriesGamesCollection;
use Game\Model\GameSeriesResult\PlayerGameSeriesScore;
use Game\Model\GameSeriesResult\PlayerGameSeriesScoreCollection;
use Game\Model\GameSeriesResult\PlayerGameSeriesScoreGroupedRankedCollection;
use Game\Model\GameSeriesResult\PlayerGameSeriesScoreGroupedSortedCollection;
use Game\Model\PlayerGameScore\PlayerGameScore;

class GameSeriesService
{
    /**
     * @var GameService
     */
    private GameService $gameService;

    /**
     * @var int
     */
    private int $gameSeriesMoveNumber;

    public function __construct(
        GameService $gameService,
        array $gameSeriesConfig
    )
    {
        $this->gameService          = $gameService;
        $this->gameSeriesMoveNumber = (int) $gameSeriesConfig['game_series_games_number'];
    }

    public function playSeries()
    {
        $playerGameSeriesScoreGroupedSortedCollection = new PlayerGameSeriesScoreCollection();
        $playerGameSeriesGamesCollection              = new PlayerGameSeriesGamesCollection();

        for ($gameIndex = 0; $gameIndex < $this->gameSeriesMoveNumber; $gameIndex++) {
            $playerGameScoreGroupedRankedCollection = $this->gameService->play();
            $playerGameSeriesGamesCollection->addGame($playerGameScoreGroupedRankedCollection);

            foreach ($playerGameScoreGroupedRankedCollection->toArray() as $gameRank => $rankCollection) {
                foreach ($rankCollection as $playerGameScore) {
                    /** @var PlayerGameScore $playerGameScore */
                    $playerGameSeriesScore = $playerGameSeriesScoreGroupedSortedCollection->findPlayerGameSeriesScore(
                        $playerGameScore->getMove()->getPlayer()
                    );

                    if (!$playerGameSeriesScoreGroupedSortedCollection->findPlayerGameSeriesScore($playerGameScore->getMove()->getPlayer())) {
                        $playerGameSeriesScoreGroupedSortedCollection->addPlayerGameSeriesScore(
                            $playerGameSeriesScore = new PlayerGameSeriesScore(
                                $playerGameScore->getMove()->getPlayer(),
                                0,
                            )
                        );
                    }

                    $playerGameSeriesScore->addScore($playerGameScore->getScore());
                }
            }
        }

        $playerGameSeriesScoreGroupedSortedCollection = $this->groupAndSortPlayerGameSeriesScore($playerGameSeriesScoreGroupedSortedCollection);
        $playerGameSeriesScoreGroupedRankedCollection = new PlayerGameSeriesScoreGroupedRankedCollection($playerGameSeriesScoreGroupedSortedCollection);

        return new GameSeriesResult(
            $playerGameSeriesScoreGroupedRankedCollection,
            $playerGameSeriesGamesCollection,
        );
    }

    /**
     * @param PlayerGameSeriesScoreCollection $playerGameSeriesScoreCollection
     *
     * @return PlayerGameSeriesScoreGroupedSortedCollection
     */
    protected function groupAndSortPlayerGameSeriesScore(PlayerGameSeriesScoreCollection $playerGameSeriesScoreCollection): PlayerGameSeriesScoreGroupedSortedCollection
    {
        return array_reduce(
            $playerGameSeriesScoreCollection->toArray(),
            fn(PlayerGameSeriesScoreGroupedSortedCollection $playerGameSeriesScoreGroupedCollection, PlayerGameSeriesScore $playerGameSeriesScore) =>
                $playerGameSeriesScoreGroupedCollection->addPlayerGameSeriesScore($playerGameSeriesScore),
            new PlayerGameSeriesScoreGroupedSortedCollection(),
        );
    }
}
