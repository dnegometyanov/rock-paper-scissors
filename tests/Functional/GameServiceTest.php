<?php declare(strict_types=1);

namespace GameTest\Functional;

use Game\Model\GameplayStrategy\ProbabilityGameplayStrategy;
use Game\Model\MoveOption\MoveOption;
use Game\Model\MoveOption\MoveOptionCollection;
use Game\Model\Player\Player;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategy;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategyCollection;
use Game\Model\PlayerGameScore\PlayerGameScore;
use Game\Service\GameplayStrategyService\GameplayStrategyServiceFactory;
use Game\Service\GameService;
use Game\Service\RulesService;
use PHPUnit\Framework\TestCase;

class GameServiceTest extends TestCase
{
    /**
     * @test
     */
    public function testGameServiceAlwaysPaperVsAlwaysRock(): void
    {
        $moveOptionCollection = new MoveOptionCollection();
        $moveOptionCollection->addMoveOption(new MoveOption('Rock'));
        $moveOptionCollection->addMoveOption(new MoveOption('Paper'));
        $moveOptionCollection->addMoveOption(new MoveOption('Scissors'));

        $moveOptionsBeatConfigThree = [
            'Rock'     => [
                'Scissors',
            ],
            'Paper'    => [
                'Rock',
            ],
            'Scissors' => [
                'Paper',
            ],
        ];

        $probabilityGameplayStrategyAlwaysPaper = new ProbabilityGameplayStrategy(
            'probability-always-paper',
            $moveOptionCollection,
            [
                'strategy_name'   => 'probability-always-paper',
                'strategy_type'   => 'strategy-probability',
                'strategy_config' => [
                    'Rock'     => 0,
                    'Paper'    => 100,
                    'Scissors' => 0,
                ]
            ],
        );

        $probabilityGameplayStrategyAlwaysRock = new ProbabilityGameplayStrategy(
            'probability-always-paper',
            $moveOptionCollection,
            [
                'strategy_name'   => 'probability-always-rock',
                'strategy_type'   => 'strategy-probability',
                'strategy_config' => [
                    'Rock'     => 100,
                    'Paper'    => 0,
                    'Scissors' => 0,
                ]
            ],
        );

        $playerA = new Player('Player A');
        $playerB = new Player('Player B');

        $playerAGameplayStrategy = new PlayerGameplayStrategy($playerA, $probabilityGameplayStrategyAlwaysPaper);
        $playerBGameplayStrategy = new PlayerGameplayStrategy($playerB, $probabilityGameplayStrategyAlwaysRock);

        $playerGameplayStrategyCollection = new PlayerGameplayStrategyCollection();
        $playerGameplayStrategyCollection
            ->addPlayerGameplayStrategy($playerAGameplayStrategy)
            ->addPlayerGameplayStrategy($playerBGameplayStrategy);

        $gameplayStrategyServiceFactory = new GameplayStrategyServiceFactory($moveOptionCollection);

        $rulesService = new RulesService($moveOptionsBeatConfigThree);

        $gameService = new GameService(
            $gameplayStrategyServiceFactory,
            $playerGameplayStrategyCollection,
            $rulesService,
        );

        $result = $gameService->play();

        $this->assertCount(2, $result->toArray());

        /** @var PlayerGameScore $firstRankPlayerGameScore */
        $firstRankPlayerGameScore = $result->toArray()[0][0];

        $this->assertInstanceOf(PlayerGameScore::class, $firstRankPlayerGameScore);
        $this->assertEquals('Player A', $firstRankPlayerGameScore->getMove()->getPlayer()->getName());
        $this->assertEquals('Paper', $firstRankPlayerGameScore->getMove()->getMoveOption()->getName());
        $this->assertEquals(1, $firstRankPlayerGameScore->getScore());

        /** @var PlayerGameScore $firstRankPlayerGameScore */
        $secondRankPlayerGameScore = $result->toArray()[1][0];

        $this->assertInstanceOf(PlayerGameScore::class, $secondRankPlayerGameScore);
        $this->assertEquals('Player B', $secondRankPlayerGameScore->getMove()->getPlayer()->getName());
        $this->assertEquals('Rock', $secondRankPlayerGameScore->getMove()->getMoveOption()->getName());
        $this->assertEquals(0, $secondRankPlayerGameScore->getScore());
    }
}
