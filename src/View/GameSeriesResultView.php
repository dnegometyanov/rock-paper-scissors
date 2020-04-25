<?php declare(strict_types=1);

namespace Game\View;

use Game\Model\GameSeriesResult\GameSeriesResult;
use Game\Model\GameSeriesResult\PlayerGameSeriesScore;
use Game\Model\GameSeriesResult\PlayerGameSeriesScoreGroupedRankedCollection;

class GameSeriesResultView implements GameSeriesViewInterface
{
    public function view(GameSeriesResult $gameSeriesResult): string
    {
        return sprintf(" ###### Game Series Summary:\n %s",
            $this->ranksSummaryView($gameSeriesResult->toArray())
        );
    }

    protected function ranksSummaryView(PlayerGameSeriesScoreGroupedRankedCollection $playerGameSeriesScoreGroupedRankedCollection): string
    {
        $rankSummaryView = '';
        foreach($playerGameSeriesScoreGroupedRankedCollection->toArray() as $rank => $playersGameSeriesScoreOfRank) {
            $rankSummaryView .= sprintf("\n      # Place %s: \n ", $rank + 1);

            foreach($playersGameSeriesScoreOfRank as $playerGameSeriesScore) {
                /** @var PlayerGameSeriesScore $playerGameSeriesScore */
                $rankSummaryView .= $this->playerOnRankView($playerGameSeriesScore);

            }
        }

        return $rankSummaryView;
    }

    protected function playerOnRankView(PlayerGameSeriesScore $playerGameSeriesScore): string
    {
        return sprintf(
            "         - %s with score %s \n",
            $playerGameSeriesScore->getPlayer()->getName(),
            $playerGameSeriesScore->getScore(),
        );
    }
}
