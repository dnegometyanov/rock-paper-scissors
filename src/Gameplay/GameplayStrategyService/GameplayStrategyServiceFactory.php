<?php declare(strict_types=1);

namespace Game\Gameplay\GameplayStrategyService;

use Game\Model\GameplayStrategy\ProbabilityGameplayStrategy;
use Game\Model\MoveOption\MoveOptionCollection;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategy;

class GameplayStrategyServiceFactory
{
    /**
     * @var MoveOptionCollection
     */
    private MoveOptionCollection $moveOptionCollection;

    public function __construct(
        MoveOptionCollection $moveOptionCollection
    )
    {
        $this->moveOptionCollection = $moveOptionCollection;
    }

    /**
     * @param PlayerGameplayStrategy $playerGameplayStrategy
     *
     * @throws \Exception
     *
     * @return GameplayStrategyServiceInterface
     */
    public function createGameplayStrategyService(PlayerGameplayStrategy $playerGameplayStrategy): GameplayStrategyServiceInterface
    {
        $gameplayStrategyType = $playerGameplayStrategy->getGameplayStrategy()->getType();
        switch ($gameplayStrategyType) {
            case ProbabilityGameplayStrategy::TYPE:
                return new ProbabilityGameplayStrategyService($playerGameplayStrategy);
                break;
            default:
                throw new \Exception(sprintf('Strategy service %s not found', $gameplayStrategyType)); // TODO custom exception
        }
    }
}
