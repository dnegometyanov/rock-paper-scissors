<?php declare(strict_types=1);

namespace Game\Model\GameplayStrategy;

use Game\Model\MoveOption\MoveOptionCollection;

class ProbabilityGameplayStrategy implements GameplayStrategyInterface
{
    const TYPE = 'strategy-probability';
    /**
     * @var string
     */
    private string $name;

    /**
     * @var MoveOptionCollection
     */
    private MoveOptionCollection $moveOptionCollection;

    /**
     * @var array
     */
    private array $strategyConfig;

    public function __construct(string $name, MoveOptionCollection $moveOptionCollection, array $strategyConfig)
    {
        $this->name                       = $name;
        $this->moveOptionCollection       = $moveOptionCollection;
        $this->strategyConfig             = $strategyConfig['strategy_config'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return MoveOptionCollection
     */
    public function getMoveOptionCollection(): MoveOptionCollection
    {
        return $this->moveOptionCollection;
    }

    /**
     * @return array
     */
    public function getStrategyConfig(): array
    {
        return $this->strategyConfig;
    }

    /**
     * @return string
     */
    public function getType(): string {
        return self::TYPE;
    }
}
