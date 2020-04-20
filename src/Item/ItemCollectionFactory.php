<?php declare(strict_types=1);

namespace Game\Item;

class ItemCollectionFactory
{
    /**
     * @var string[]
     */
    private array $itemNames;

    /**
     * @param string[] $itemNames List of existing item names
     */
    public function __construct(array $itemNames)
    {
        $this->itemNames = $itemNames;
    }

    /**
     * @return ItemCollection
     */
    public function create(): ItemCollection
    {
        return array_reduce(
            $this->itemNames,
            fn (ItemCollection $itemCollection, string $itemName) => $itemCollection->addItem(new Item($itemName)),
            new ItemCollection()
        );
    }
}