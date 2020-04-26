<?php declare(strict_types=1);

namespace Game\View;

use Game\Model\GameSeriesResult\GameSeriesResult;

interface GameSeriesResultViewInterface
{

    public function view(GameSeriesResult $gameSeriesResult): string;
}
