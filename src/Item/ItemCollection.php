<?php declare(strict_types=1);

namespace Game\Item;

class ItemCollection
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }
    public function addItem(ItemInterface $item): ItemCollection
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param string $itemName
     *
     * @return Item
     */
    public function findItem(string $itemName): Item
    {
        return current(array_filter( $this->items, fn (Item $item) => $itemName === $item->getName()));
    }
}