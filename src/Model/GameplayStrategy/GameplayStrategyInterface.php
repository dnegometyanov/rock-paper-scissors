<?php declare(strict_types=1);

namespace Game\Model\GameplayStrategy;

use Game\Model\MoveOption\MoveOptionCollection;

interface GameplayStrategyInterface
{
    public function getName(): string;

    public function getMoveOptionCollection(): MoveOptionCollection;

    public function getStrategyConfig(): array;

    public function getType(): string;
}
