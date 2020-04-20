<?php declare(strict_types=1);

namespace Game\Gameplay\GameplayStrategy;

use Game\Model\MoveOption\MoveOption;

interface GameplayStrategyInterface
{
    public function selectMoveOption(): MoveOption;

    public function getName(): string;

    public static function getType(): string;
}
