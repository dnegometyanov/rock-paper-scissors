<?php declare(strict_types=1);

namespace Game\Model\Player;

use Game\Gameplay\GameplayStrategy\GameplayStrategyInterface;
use Game\Model\MoveOption\MoveOptionCollection as ItemCollectionAlias;
use Game\Model\MoveOption\MoveOptionInterface;
use Game\Util\WeightedRandom;

class ProbabilityGameplayStrategy implements GameplayStrategyInterface
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
     * @return MoveOptionInterface
     */
    public function selectItem(): MoveOptionInterface
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