<?php declare(strict_types=1);

namespace Game\View;

use Game\Model\GameSeriesResult\GameSeriesResult;
use Game\Model\GameSeriesResult\PlayerGameSeriesScore;
use Game\Model\GameSeriesResult\PlayerGameSeriesScoreCollection;

class GameSeriesResultView implements GameSeriesViewInterface
{
    public function view(GameSeriesResult $gameSeriesResult): string
    {
        return sprintf("\n\033[1mGame Series Summary:\033[0m\n %s",
            $this->summaryItemsView($gameSeriesResult->getPlayerGameSeriesScoreCollection())
        );
    }

    protected function summaryItemsView(PlayerGameSeriesScoreCollection $playerGameSeriesScoreCollection): string
    {
        return array_reduce(
            $playerGameSeriesScoreCollection->toArray(),
            fn(string $template, PlayerGameSeriesScore $playerGameSeriesScore) => $template = sprintf("%s \n %s", $template, $this->summaryItemView($playerGameSeriesScore)),
            ''
        );
    }

    protected function summaryItemView(PlayerGameSeriesScore $playerGameSeriesScore): string
    {
        return sprintf(
            '%s with score %s',
            $playerGameSeriesScore->getPlayer()->getName(),
            $playerGameSeriesScore->getScore(),
        );
    }
}
