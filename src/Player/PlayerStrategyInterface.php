<?php declare(strict_types=1);

namespace Game\Player;

use Game\Item\ItemInterface;

interface PlayerStrategyInterface
{
    public function selectItem(): ItemInterface;

    public static function getName(): string;
}