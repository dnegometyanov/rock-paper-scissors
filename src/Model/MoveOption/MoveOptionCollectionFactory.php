<?php declare(strict_types=1);

namespace Game\Model\MoveOption;

class MoveOptionCollectionFactory
{
    /**
     * @param array $itemNames
     *
     * @return MoveOptionCollection
     */
    public function create(array $itemNames): MoveOptionCollection
    {
        return array_reduce(
            $itemNames,
            fn (MoveOptionCollection $moveOptionCollection, string $moveOptionName) => $moveOptionCollection->addMoveOption(new MoveOption($moveOptionName)),
            new MoveOptionCollection()
        );
    }
}