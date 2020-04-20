<?php declare(strict_types=1);

namespace Game\Player;

use Game\Item\ItemCollection as ItemCollectionAlias;
use Game\Item\ItemInterface;
use Game\Util\WeightedRandom;

class ProbabilityPlayerStrategy implements PlayerStrategyInterface
{
    /**
     * @var ItemCollectionAlias
     */
    private ItemCollectionAlias $itemCollection;

    /**
     * @var array
     */
    private array $probabilityStrategyConfig;

    public function __construct(ItemCollectionAlias $itemCollection, array $probabilityStrategyConfig)
    {
        $this->itemCollection            = $itemCollection;
        $this->probabilityStrategyConfig = $probabilityStrategyConfig;
    }

    /**
     * @return ItemInterface
     */
    public function selectItem(): ItemInterface
    {
        $weightedRandomItemName = WeightedRandom::getWeightedRandomElement($this->probabilityStrategyConfig);

        return $this->itemCollection->findItem($weightedRandomItemName);
    }

    /**
     * @return string
     */
    public static function getName(): string {
        return 'strategy-probability';
    }
}