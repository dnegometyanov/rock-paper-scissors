<?php declare(strict_types=1);

namespace Game\Item;

class ItemCollectionFactory
{
    /**
     * @param array $itemNames
     *
     * @return ItemCollection
     */
    public function create(array $itemNames): ItemCollection
    {
        return array_reduce(
            $itemNames,
            fn (ItemCollection $itemCollection, string $itemName) => $itemCollection->addItem(new Item($itemName)),
            new ItemCollection()
        );
    }
}