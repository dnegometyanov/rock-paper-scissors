<?php declare(strict_types=1);

namespace Game\Player;

use Game\Item\ItemInterface;

interface PlayerInterface
{
    public function selectItem(): ItemInterface;

    public function getName(): string;
}