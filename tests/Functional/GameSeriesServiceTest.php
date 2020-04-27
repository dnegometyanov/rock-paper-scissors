<?php declare(strict_types=1);

namespace GameTest\Functional;

use Game\Model\GameplayStrategy\ProbabilityGameplayStrategy;
use Game\Model\GameSeriesResult\PlayerGameSeriesScore;
use Game\Model\GameSeriesResult\PlayerGameSeriesScoreGroupedRankedCollection;
use Game\Model\MoveOption\MoveOption;
use Game\Model\MoveOption\MoveOptionCollection;
use Game\Model\Player\Player;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategy;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategyCollection;
use Game\Model\PlayerGameScore\PlayerGameScore;
use Game\Model\PlayerGameScore\PlayerGameScoreGroupedRankedCollection;
use Game\Service\GameplayStrategyService\GameplayStrategyServiceFactory;
use Game\Service\GameSeriesService;
use Game\Service\GameService;
use Game\Service\RulesService;
use PHPUnit\Framework\TestCase;

class GameSeriesServiceTest extends TestCase
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

        $gameSeriesService = new GameSeriesService(
            $gameService,
            ['game_series_games_number' => 100],
        );

        $result = $gameSeriesService->playSeries();

        $this->assertCount(2, $result->getPlayerGameSeriesScoreGroupedRankedCollection()->toArray());

        /** @var PlayerGameSeriesScore $firstRankPlayerGameSeriesScore */
        $firstRankPlayerGameSeriesScore = $result->getPlayerGameSeriesScoreGroupedRankedCollection()->toArray()[0][0];

        $this->assertInstanceOf(PlayerGameSeriesScore::class, $result->getPlayerGameSeriesScoreGroupedRankedCollection()->toArray()[0][0]);
        $this->assertEquals('Player A', $firstRankPlayerGameSeriesScore->getPlayer()->getName());
        $this->assertEquals(100, $firstRankPlayerGameSeriesScore->getScore());

        /** @var PlayerGameSeriesScore $firstRankPlayerGameSeriesScore */
        $secondRankPlayerGameSeriesScore = $result->getPlayerGameSeriesScoreGroupedRankedCollection()->toArray()[1][0];

        $this->assertInstanceOf(PlayerGameSeriesScore::class, $secondRankPlayerGameSeriesScore);
        $this->assertEquals('Player B', $secondRankPlayerGameSeriesScore->getPlayer()->getName());
        $this->assertEquals(0, $secondRankPlayerGameSeriesScore->getScore());


        $this->assertInstanceOf(PlayerGameScoreGroupedRankedCollection::class, $result->getPlayerGameSeriesGamesCollection()->toArray()[0]);

        /** @var PlayerGameSeriesScoreGroupedRankedCollection $firstGamePlayerGameScoreGroupedRankedCollection */
        $firstGamePlayerGameScoreGroupedRankedCollection = $result->getPlayerGameSeriesGamesCollection()->toArray()[0];

        /** @var PlayerGameScore $firstGameFirstRankPlayerGameScore */
        $firstGameFirstRankPlayerGameScore = $firstGamePlayerGameScoreGroupedRankedCollection->toArray()[0][0];

        $this->assertInstanceOf(PlayerGameScore::class, $firstGameFirstRankPlayerGameScore);
        $this->assertEquals('Paper', $firstGameFirstRankPlayerGameScore->getMove()->getMoveOption()->getName());
        $this->assertEquals('Player A', $firstGameFirstRankPlayerGameScore->getMove()->getPlayer()->getName());
        $this->assertEquals(1, $firstGameFirstRankPlayerGameScore->getScore());

        /** @var PlayerGameScore $firstGameFirstRankPlayerGameScore */
        $firstGameSecondRankPlayerGameScore = $firstGamePlayerGameScoreGroupedRankedCollection->toArray()[1][0];

        $this->assertInstanceOf(PlayerGameScore::class, $firstGameSecondRankPlayerGameScore);
        $this->assertEquals('Rock', $firstGameSecondRankPlayerGameScore->getMove()->getMoveOption()->getName());
        $this->assertEquals('Player B', $firstGameSecondRankPlayerGameScore->getMove()->getPlayer()->getName());
        $this->assertEquals(0, $firstGameSecondRankPlayerGameScore->getScore());

    }
}
