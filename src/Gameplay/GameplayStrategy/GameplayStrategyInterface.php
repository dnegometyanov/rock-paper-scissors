<?php declare(strict_types=1);

namespace Game\Gameplay\GameplayStrategy;

use Game\Model\MoveOption\MoveOptionInterface;

interface GameplayStrategyInterface
{
    public function selectItem(): MoveOptionInterface;

    public static function getName(): string;
}
