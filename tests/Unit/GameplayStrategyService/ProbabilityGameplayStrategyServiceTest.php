<?php declare(strict_types=1);

namespace GameTest\Unit\GameplayStrategyService;

use Game\Model\GameplayStrategy\ProbabilityGameplayStrategy;
use Game\Model\MoveOption\MoveOption;
use Game\Model\MoveOption\MoveOptionCollection;
use Game\Model\Player\Player;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategy;
use Game\Service\GameplayStrategyService\ProbabilityGameplayStrategyService;
use PHPUnit\Framework\TestCase;

class ProbabilityGameplayStrategyServiceTest extends TestCase
{
    /**
     * @test
     */
    public function testGameSeriesWithDefaultConfigThreeItemsPaperScissors(): void
    {
        $moveOptionCollection = new MoveOptionCollection();
        $moveOptionCollection->addMoveOption(new MoveOption('Rock'));
        $moveOptionCollection->addMoveOption(new MoveOption('Paper'));
        $moveOptionCollection->addMoveOption(new MoveOption('Scissors'));

        $probabilityGameplayStrategyConfig = [
            'strategy_name'   => 'probability-always-paper',
            'strategy_type'   => 'strategy-probability',
            'strategy_config' => [
                'Rock'     => 0,
                'Paper'    => 100,
                'Scissors' => 0,
            ]
        ];

        $probabilityGameplayStrategy = new ProbabilityGameplayStrategy(
            'probability-always-paper',
            $moveOptionCollection,
            $probabilityGameplayStrategyConfig,
        );

        $playerA = new Player('Player A');

        $playerGameplayStrategy = new PlayerGameplayStrategy($playerA, $probabilityGameplayStrategy);

        $rulesService = new ProbabilityGameplayStrategyService($playerGameplayStrategy);

        $result = $rulesService->move();

        $this->assertEquals('Paper', $result->getMoveOption()->getName());
        $this->assertEquals('Player A', $result->getPlayer()->getName());
    }
}
