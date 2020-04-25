<?php declare(strict_types=1);

namespace Game\Service\GameplayStrategyService;

use Game\Model\Move\Move;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategy;
use Game\Util\WeightedRandom;

class ProbabilityGameplayStrategyService implements GameplayStrategyServiceInterface
{
    /**
     * @var PlayerGameplayStrategy
     */
    private PlayerGameplayStrategy $playerGameplayStrategy;

    public function __construct(PlayerGameplayStrategy $playerGameplayStrategy)
    {
        $this->playerGameplayStrategy = $playerGameplayStrategy;
    }

    /**
     * @return Move
     */
    public function move(): Move
    {
        $probabilitiesOfMoveOptions = $this->playerGameplayStrategy->getGameplayStrategy()->getStrategyConfig();
        $moveOptionCollection       = $this->playerGameplayStrategy->getGameplayStrategy()->getMoveOptionCollection();

        $weightedRandomMoveOptionName = WeightedRandom::getWeightedRandomElement($probabilitiesOfMoveOptions);

        return new Move(
            $this->playerGameplayStrategy->getPlayer(),
            $moveOptionCollection->findMoveOption($weightedRandomMoveOptionName)
        );
    }
}
