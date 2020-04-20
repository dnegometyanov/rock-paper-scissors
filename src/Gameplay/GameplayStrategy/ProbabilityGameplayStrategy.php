<?php declare(strict_types=1);

namespace Game\Gameplay\GameplayStrategy;

use Game\Model\MoveOption\MoveOption;
use Game\Model\MoveOption\MoveOptionCollection;
use Game\Util\WeightedRandom;

class ProbabilityGameplayStrategy implements GameplayStrategyInterface
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var MoveOptionCollection
     */
    private MoveOptionCollection $itemCollection;

    /**
     * @var array
     */
    private array $probabilitiesOfMoveOptions;

    public function __construct(string $name, MoveOptionCollection $moveOptionCollection, array $strategyConfig)
    {
        $this->name                       = $name;
        $this->itemCollection             = $moveOptionCollection;
        $this->probabilitiesOfMoveOptions = $strategyConfig;
    }

    /**
     * @return MoveOption
     */
    public function selectMoveOption(): MoveOption
    {
        $weightedRandomMoveOptionName = WeightedRandom::getWeightedRandomElement($this->probabilitiesOfMoveOptions);

        return $this->itemCollection->findItem($weightedRandomMoveOptionName);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public static function getType(): string {
        return 'strategy-probability';
    }
}
