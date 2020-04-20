<?php declare(strict_types=1);

namespace Game\Model\Player;

use Game\Model\MoveOption\MoveOptionInterface;

interface PlayerInterface
{
    public function selectItem(): MoveOptionInterface;

    public function getName(): string;
}
