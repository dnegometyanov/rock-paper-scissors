<?php declare(strict_types=1);

namespace Game\View;

use Game\Model\GameSeriesResult\GameSeriesResult;

class GameSeriesResultViewFactory
{
    /**
     * @param GameSeriesResult $gameSeriesResult
     *
     * @return GameSeriesResultViewInterface
     */
    public function createView(GameSeriesResult $gameSeriesResult): GameSeriesResultViewInterface
    {
        return new GameSeriesResultResultView();
    }
}
