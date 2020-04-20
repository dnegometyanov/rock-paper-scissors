<?php declare(strict_types=1);

namespace Game\Player;

use Game\Item\ItemInterface;

class Player implements PlayerInterface
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var PlayerStrategyInterface
     */
    private PlayerStrategyInterface $playerStrategy;

    public function __construct(string $name, PlayerStrategyInterface $playerStrategy)
    {
        $this->name           = $name;
        $this->playerStrategy = $playerStrategy;
    }

    /**
     * @return ItemInterface
     */
    public function selectItem(): ItemInterface
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