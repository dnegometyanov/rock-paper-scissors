<?php declare(strict_types=1);

namespace Game\View;

use Game\Model\GameSeriesResult\GameSeriesResult;
use Game\Model\GameSeriesResult\PlayerGameSeriesGamesCollection;
use Game\Model\GameSeriesResult\PlayerGameSeriesScore;
use Game\Model\GameSeriesResult\PlayerGameSeriesScoreGroupedRankedCollection;
use Game\Model\PlayerGameScore\PlayerGameScore;
use Game\Model\PlayerGameScore\PlayerGameScoreGroupedRankedCollection;

class GameSeriesResultResultView implements GameSeriesResultViewInterface
{
    /**
     * @param GameSeriesResult $gameSeriesResult
     *
     * @return string
     */
    public function view(GameSeriesResult $gameSeriesResult): string
    {
        return sprintf("\nGame Series Summary:\n%s \n" .
                              "Games log:\n%s",
            $this->ranksSummaryView($gameSeriesResult->getPlayerGameSeriesScoreGroupedRankedCollection()),
            $this->gamesView($gameSeriesResult->getPlayerGameSeriesGamesCollection()),
        );
    }

    /**
     * @param PlayerGameSeriesGamesCollection $playerGameSeriesGamesCollection
     *
     * @return string
     */
    protected function gamesView(PlayerGameSeriesGamesCollection $playerGameSeriesGamesCollection): string
    {
        $gamesView = '';
        foreach($playerGameSeriesGamesCollection->toArray() as $gameNumber => $playerGameScoreGroupedRankedCollection) {
            /** @var PlayerGameScoreGroupedRankedCollection $playerGameScoreGroupedRankedCollection */
            $gamesView .= sprintf("\n      Game %s:\n ", $gameNumber + 1);

            $isDraw = $playerGameScoreGroupedRankedCollection->getCount() === 1;

            foreach($playerGameScoreGroupedRankedCollection->toArray() as $gameRank => $playersOfRank) {
                if ($isDraw) {
                    $gamesView .= sprintf("\n            Draw: \n");
                } else {
                    $gamesView .= sprintf("\n            Place %s: \n", $gameRank + 1);
                }

                foreach ($playersOfRank as $playerGameScore) {
                    /** @var PlayerGameScore $playerGameScore */
                    $gamesView .= $this->playerGameScoreView($playerGameScore);
                }
            }
        }

        return $gamesView;
    }

    /**
     * @param PlayerGameSeriesScoreGroupedRankedCollection $playerGameSeriesScoreGroupedRankedCollection
     *
     * @return string
     */
    protected function ranksSummaryView(PlayerGameSeriesScoreGroupedRankedCollection $playerGameSeriesScoreGroupedRankedCollection): string
    {
        $rankSummaryView = '';
        foreach($playerGameSeriesScoreGroupedRankedCollection->toArray() as $rank => $playersGameSeriesScoreOfRank) {
            $rankSummaryView .= sprintf("\n      Place %s: \n ", $rank + 1);

            foreach($playersGameSeriesScoreOfRank as $playerGameSeriesScore) {
                /** @var PlayerGameSeriesScore $playerGameSeriesScore */
                $rankSummaryView .= $this->playerOnRankView($playerGameSeriesScore);

            }
        }

        return $rankSummaryView;
    }

    /**
     * @param PlayerGameSeriesScore $playerGameSeriesScore
     *
     * @return string
     */
    protected function playerOnRankView(PlayerGameSeriesScore $playerGameSeriesScore): string
    {
        return sprintf(
            "            - %s with score %s \n",
            $playerGameSeriesScore->getPlayer()->getName(),
            $playerGameSeriesScore->getScore(),
        );
    }

    /**
     * @param PlayerGameScore $playerGameScore
     *
     * @return string
     */
    protected function  playerGameScoreView(PlayerGameScore $playerGameScore): string
    {
        return sprintf(
            "                  - %s selected %s and got score %s \n",
            $playerGameScore->getMove()->getPlayer()->getName(),
            $playerGameScore->getMove()->getMoveOption()->getName(),
            $playerGameScore->getScore(),
        );
    }
}
