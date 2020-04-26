<?php declare(strict_types=1);

namespace GameTest\Functional;

use Game\App;
use Game\Model\GameSeriesResult\GameSeriesResult;
use GameTest\Functional\Config\ConfigDefaultTwoPlayersRockPaperScissors;
use GameTest\Functional\Config\ConfigTwoPlayersPlayerBAlwaysWins;
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
    public function testGameSeriesWithPlayerBAlwaysWinsConfig(): void
    {
        $app    = new App(new ConfigTwoPlayersPlayerBAlwaysWins());
        $result = $app->runGameSeries();

        $this->assertInstanceOf(GameSeriesResult::class, $result);
        $this->assertCount(2, $result->getPlayerGameSeriesScoreGroupedRankedCollection()->toArray());
        $this->assertCount(100, $result->getPlayerGameSeriesGamesCollection()->toArray());
        $this->assertEquals('Player B', $result->getPlayerGameSeriesScoreGroupedRankedCollection()
                                            ->toArray()[0][0]->getPlayer()->getName());
        $this->assertEquals('100', $result->getPlayerGameSeriesScoreGroupedRankedCollection()
            ->toArray()[0][0]->getScore());
        $this->assertEquals('Player A', $result->getPlayerGameSeriesScoreGroupedRankedCollection()
            ->toArray()[1][0]->getPlayer()->getName());
        $this->assertEquals('0', $result->getPlayerGameSeriesScoreGroupedRankedCollection()
            ->toArray()[1][0]->getScore());
    }
}
