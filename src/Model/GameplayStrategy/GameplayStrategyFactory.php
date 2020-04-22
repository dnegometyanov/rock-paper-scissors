<?php declare(strict_types=1);

namespace Game\Model\GameplayStrategy;

use Game\Model\MoveOption\MoveOptionCollection;

class GameplayStrategyFactory
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
     * @param string $strategyType
     * @param string $strategyName
     * @param array $strategyConfig
     *
     * @throws \Exception
     *
     * @return GameplayStrategyInterface
     *
     */
    public function createStrategy(string $strategyType, string $strategyName, array $strategyConfig): GameplayStrategyInterface
    {
        switch ($strategyType) {
            case ProbabilityGameplayStrategy::TYPE:
                return new ProbabilityGameplayStrategy($strategyName, $this->moveOptionCollection, $strategyConfig);
                break;
            default:
                throw new \Exception(sprintf('Strategy %s not found', $strategyType)); // TODO custom exception
        }
    }
}
