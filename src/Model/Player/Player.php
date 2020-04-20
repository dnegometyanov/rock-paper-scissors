<?php declare(strict_types=1);

namespace Game\Model\Player;

use Game\Gameplay\GameplayStrategy\GameplayStrategyInterface;
use Game\Model\MoveOption\MoveOptionInterface;

class Player implements PlayerInterface
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var GameplayStrategyInterface
     */
    private GameplayStrategyInterface $playerStrategy;

    public function __construct(string $name, GameplayStrategyInterface $playerStrategy)
    {
        $this->name           = $name;
        $this->playerStrategy = $playerStrategy;
    }

    /**
     * @return MoveOptionInterface
     */
    public function selectItem(): MoveOptionInterface
    {
        return $this->playerStrategy->selectItem();
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
}
