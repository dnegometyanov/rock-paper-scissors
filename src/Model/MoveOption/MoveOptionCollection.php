<?php declare(strict_types=1);

namespace Game\Model\MoveOption;

class MoveOptionCollection
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function addMoveOption(MoveOption $item): MoveOptionCollection
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return MoveOption[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param string $itemName
     *
     * @return MoveOption
     */
    public function findItem(string $itemName): MoveOption
    {
        return current(array_filter( $this->items, fn (MoveOption $item) => $itemName === $item->getName()));
    }
}
