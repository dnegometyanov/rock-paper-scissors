<?php declare(strict_types=1);

namespace Game\Service;

use Game\Model\GameSeriesResult\GameSeriesResult;
use Game\Model\GameSeriesResult\PlayerGameSeriesGamesCollection;
use Game\Model\GameSeriesResult\PlayerGameSeriesScore;
use Game\Model\GameSeriesResult\PlayerGameSeriesScoreCollection;
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
        $this->gameSeriesMoveNumber = (int)$gameSeriesConfig['game_series_move_number'];
    }

    public function playSeries()
    {
        $playerGameSeriesScoreCollection = new PlayerGameSeriesScoreCollection();
        $playerGameSeriesGamesCollection = new PlayerGameSeriesGamesCollection();

        for ($gameIndex = 0; $gameIndex < $this->gameSeriesMoveNumber; $gameIndex++) {
            $playerGameScoreGroupedRankedCollection = $this->gameService->play();
            $playerGameSeriesGamesCollection->addGame($playerGameScoreGroupedRankedCollection);

            foreach ($playerGameScoreGroupedRankedCollection->getGameScoreGroupedRanked() as $gameRank => $rankCollection) {
                foreach ($rankCollection as $playerGameScore) {
                    /** @var PlayerGameScore $playerGameScore */
                    $playerGameSeriesScore = $playerGameSeriesScoreCollection->findPlayerGameSeriesScore(
                        $playerGameScore->getMove()->getPlayer()
                    );

                    if (!$playerGameSeriesScoreCollection->findPlayerGameSeriesScore($playerGameScore->getMove()->getPlayer())) {
                        $playerGameSeriesScoreCollection->addPlayerGameSeriesScore(
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

        return new GameSeriesResult(
            $playerGameSeriesScoreCollection,
            $playerGameSeriesGamesCollection,
        );
    }
}
