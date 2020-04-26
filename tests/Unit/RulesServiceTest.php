<?php declare(strict_types=1);

namespace GameTest\Unit;

use Game\Model\Move\Move;
use Game\Model\MoveOption\MoveOption;
use Game\Model\Player\Player;
use Game\Service\RulesService;
use PHPUnit\Framework\TestCase;

class RulesServiceTest extends TestCase
{
    /**
     * @var string[][]
     */
    private array $moveOptionsBeatConfigThree;

    /**
     * @var \string[][]
     */
    private array $moveOptionsBeatConfigFive;

    private function init(): void {

        $this->moveOptionsBeatConfigThree = [
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

        $this->moveOptionsBeatConfigFive = [
            'Rock'     => [
                'Lizard',
                'Scissors',
            ],
            'Paper'    => [
                'Rock',
                'Spock',
            ],
            'Scissors' => [
                'Paper',
                'Lizard',
            ],
            'Spock' => [
                'Scissors',
                'Rock',
            ],
            'Lizard'    => [
                'Paper',
                'Spock',
            ],
        ];

    }

    /**
     * Test with default three items config Scissors beat Paper
     *
     * @test
     */
    public function testGameServiceWithDefaultConfigThreeItemsScissorsBeatPaper(): void
    {
        $this->init();

        $movePlayerMock = $this->createMock(Move::class);
        $movePlayerMock->method('getPlayer')
            ->willReturn(new Player('Player A'));
        $movePlayerMock->method('getMoveOption')
            ->willReturn(new MoveOption('Paper'));

        $moveCompetitorMock = $this->createMock(Move::class);
        $moveCompetitorMock->method('getPlayer')
            ->willReturn(new Player('Player B'));
        $moveCompetitorMock->method('getMoveOption')
            ->willReturn(new MoveOption('Scissors'));

        $rulesService = new RulesService($this->moveOptionsBeatConfigThree);

        $result = $rulesService->selectWinnerOfTwo($movePlayerMock, $moveCompetitorMock);
        $this->assertEquals('Player B', $result->getName());
    }

    /**
     * Test with default three items config Paper beats Rock
     *
     * @test
     */
    public function testGameServiceWithDefaultConfigThreeItemsPaperBeatsRock(): void
    {
        $this->init();

        $movePlayerMock = $this->createMock(Move::class);
        $movePlayerMock->method('getPlayer')
            ->willReturn(new Player('Player A'));
        $movePlayerMock->method('getMoveOption')
            ->willReturn(new MoveOption('Paper'));

        $moveCompetitorMock = $this->createMock(Move::class);
        $moveCompetitorMock->method('getPlayer')
            ->willReturn(new Player('Player B'));
        $moveCompetitorMock->method('getMoveOption')
            ->willReturn(new MoveOption('Rock'));

        $rulesService = new RulesService($this->moveOptionsBeatConfigThree);

        $result = $rulesService->selectWinnerOfTwo($movePlayerMock, $moveCompetitorMock);
        $this->assertEquals('Player A', $result->getName());
    }

    /**
     * Test with default three items config Rock beats Scissors
     *
     * @test
     */
    public function testGameServiceWithDefaultConfigThreeItemsRockBeatsScissors(): void
    {
        $this->init();

        $movePlayerMock = $this->createMock(Move::class);
        $movePlayerMock->method('getPlayer')
            ->willReturn(new Player('Player A'));
        $movePlayerMock->method('getMoveOption')
            ->willReturn(new MoveOption('Scissors'));

        $moveCompetitorMock = $this->createMock(Move::class);
        $moveCompetitorMock->method('getPlayer')
            ->willReturn(new Player('Player B'));
        $moveCompetitorMock->method('getMoveOption')
            ->willReturn(new MoveOption('Rock'));

        $rulesService = new RulesService($this->moveOptionsBeatConfigThree);

        $result = $rulesService->selectWinnerOfTwo($movePlayerMock, $moveCompetitorMock);
        $this->assertEquals('Player B', $result->getName());
    }

    /**
     * Test with default config Lizard beats Spock
     *
     * @test
     */
    public function testGameServiceWithFiveItemsConfigSpockBeatsSpock(): void
    {
        $this->init();

        $movePlayerMock = $this->createMock(Move::class);
        $movePlayerMock->method('getPlayer')
            ->willReturn(new Player('Player A'));
        $movePlayerMock->method('getMoveOption')
            ->willReturn(new MoveOption('Lizard'));

        $moveCompetitorMock = $this->createMock(Move::class);
        $moveCompetitorMock->method('getPlayer')
            ->willReturn(new Player('Player B'));
        $moveCompetitorMock->method('getMoveOption')
            ->willReturn(new MoveOption('Spock'));

        $rulesService = new RulesService($this->moveOptionsBeatConfigFive);

        $result = $rulesService->selectWinnerOfTwo($movePlayerMock, $moveCompetitorMock);
        $this->assertEquals('Player A', $result->getName());
    }

    /**
     * Test with default config Lizard beats Spock
     *
     * @test
     */
    public function testGameServiceWithFiveItemsConfigSpockBeatsPaper(): void
    {
        $this->init();

        $movePlayerMock = $this->createMock(Move::class);
        $movePlayerMock->method('getPlayer')
            ->willReturn(new Player('Player A'));
        $movePlayerMock->method('getMoveOption')
            ->willReturn(new MoveOption('Lizard'));

        $moveCompetitorMock = $this->createMock(Move::class);
        $moveCompetitorMock->method('getPlayer')
            ->willReturn(new Player('Player B'));
        $moveCompetitorMock->method('getMoveOption')
            ->willReturn(new MoveOption('Paper'));

        $rulesService = new RulesService($this->moveOptionsBeatConfigFive);

        $result = $rulesService->selectWinnerOfTwo($movePlayerMock, $moveCompetitorMock);
        $this->assertEquals('Player A', $result->getName());
    }
}
