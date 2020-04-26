<?php declare(strict_types=1);

namespace GameTest\Functional;

use Game\App;
use Game\Model\GameSeriesResult\GameSeriesResult;
use Game\Model\PlayerGameScore\PlayerGameScore;
use Game\Model\PlayerGameScore\PlayerGameScoreGroupedRankedCollection;
use GameTest\Functional\Config\ConfigDefaultTwoPlayersRockPaperScissors;
use GameTest\Functional\Config\ConfigThreePlayersFiveItemsRockPaperScissorsSpockLizard;
use GameTest\Functional\Config\ConfigTwoPlayersPlayerBAlwaysWinsSeriesOfTwoGames;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    /**
     * Test with default config
     *
     * @test
     */
    public function testGameSeriesWithDefaultConfig(): void
    {
        $app    = new App(new ConfigDefaultTwoPlayersRockPaperScissors());
        $result = $app->runGameSeries();

        $this->assertInstanceOf(GameSeriesResult::class, $result);
        $this->assertCount(100, $result->getPlayerGameSeriesGamesCollection()->toArray());
    }

    /**
     * Test with default config
     *
     * @test
     */
    public function testGameSeriesWithPlayerBAlwaysWinsConfigSeriesOfTwoGames(): void
    {
        $app    = new App(new ConfigTwoPlayersPlayerBAlwaysWinsSeriesOfTwoGames());
        $result = $app->runGameSeries();

        $this->assertInstanceOf(GameSeriesResult::class, $result);
        $this->assertCount(2, $result->getPlayerGameSeriesScoreGroupedRankedCollection()->toArray());
        $this->assertCount(2, $result->getPlayerGameSeriesGamesCollection()->toArray());
        $this->assertEquals('Player B', $result->getPlayerGameSeriesScoreGroupedRankedCollection()
                                            ->toArray()[0][0]->getPlayer()->getName());
        $this->assertEquals('2', $result->getPlayerGameSeriesScoreGroupedRankedCollection()
            ->toArray()[0][0]->getScore());
        $this->assertEquals('Player A', $result->getPlayerGameSeriesScoreGroupedRankedCollection()
            ->toArray()[1][0]->getPlayer()->getName());
        $this->assertEquals('0', $result->getPlayerGameSeriesScoreGroupedRankedCollection()
            ->toArray()[1][0]->getScore());

        $this->assertInstanceOf(PlayerGameScoreGroupedRankedCollection::class, $result->getPlayerGameSeriesGamesCollection()->toArray()[0]);

        $this->assertInstanceOf(PlayerGameScore::class, $result->getPlayerGameSeriesGamesCollection()->toArray()[0]->toArray()[0][0]);

        $this->assertEquals('Player B', $result->getPlayerGameSeriesGamesCollection()->toArray()[0]->toArray()[0][0]->getMove()->getPlayer()->getName());
        $this->assertEquals(1, $result->getPlayerGameSeriesGamesCollection()->toArray()[0]->toArray()[0][0]->getScore());

        $this->assertEquals('Player A', $result->getPlayerGameSeriesGamesCollection()->toArray()[0]->toArray()[1][0]->getMove()->getPlayer()->getName());
        $this->assertEquals(0, $result->getPlayerGameSeriesGamesCollection()->toArray()[0]->toArray()[1][0]->getScore());
    }

    /**
     * Test with 5 items and 3 players config (Spock-lizard)
     *
     * @test
     */
    public function testGameSeriesWithFiveItemsThreePlayersConfig(): void
    {
        $app    = new App(new ConfigThreePlayersFiveItemsRockPaperScissorsSpockLizard());
        $result = $app->runGameSeries();

        $this->assertInstanceOf(GameSeriesResult::class, $result);
        $this->assertCount(3, $result->getPlayerGameSeriesScoreGroupedRankedCollection()->toArray());
        $this->assertCount(100, $result->getPlayerGameSeriesGamesCollection()->toArray());
    }
}
