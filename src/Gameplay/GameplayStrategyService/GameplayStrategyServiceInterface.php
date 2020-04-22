<?php declare(strict_types=1);

namespace Game\Gameplay\GameplayStrategyService;

use Game\Model\Move\Move;

interface GameplayStrategyServiceInterface
{
    public function move(): Move;
}
