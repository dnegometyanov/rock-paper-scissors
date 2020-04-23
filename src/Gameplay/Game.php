<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Gameplay\GameplayStrategyService\GameplayStrategyServiceFactory;
use Game\Model\Move\Move;
use Game\Model\Move\MoveCollection;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategy;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategyCollection;
use Game\Model\PlayerGameScore\PlayerGameScore;
use Game\Model\PlayerGameScore\PlayerGameScoreCollection;
use Game\Model\PlayerGameScore\PlayerGameScoreGroupedCollection;

class Game
{
    /**
     * @var GameplayStrategyServiceFactory
     */
    private GameplayStrategyServiceFactory $gameplayStrategyServiceFactory;

    /**
     * @var PlayerGameplayStrategyCollection
     */
    private PlayerGameplayStrategyCollection $playerGameplayStrategyCollection;

    /**
     * @var Rules
     */
    private Rules $rules;

    public function __construct(
        GameplayStrategyServiceFactory $gameplayStrategyServiceFactory,
        PlayerGameplayStrategyCollection $playerGameplayStrategyCollection,
        Rules $rules
    )
    {
        $this->gameplayStrategyServiceFactory   = $gameplayStrategyServiceFactory;
        $this->playerGameplayStrategyCollection = $playerGameplayStrategyCollection;
        $this->rules                            = $rules;
    }

    public function play()
    {
        $moveCollection                   = $this->getPlayerMoves();
        $playerGameScoreCollection        = $this->calculatePlayerGameScoreScore($moveCollection);
        $playerGameScoreGroupedCollection = $this->groupPlayerGameScore($playerGameScoreCollection);

        return $playerGameScoreGroupedCollection;
    }

    public function getPlayerMoves(): MoveCollection
    {
        return array_reduce(
            $this->playerGameplayStrategyCollection->getPlayerGameplayStrategies(),
            fn(MoveCollection $moveCollection, PlayerGameplayStrategy $playerGameplayStrategy) => $moveCollection->addMove(
                $this->gameplayStrategyServiceFactory->createGameplayStrategyService($playerGameplayStrategy)->move()
            ),
            new MoveCollection(),
        );
    }

    /**
     * @param MoveCollection $moveCollection
     *
     * @return PlayerGameScoreCollection
     */
    public function calculatePlayerGameScoreScore(MoveCollection $moveCollection): PlayerGameScoreCollection
    {
        /** @var PlayerGameScoreCollection $playerGameScoreCollection */
        $playerGameScoreCollection = array_reduce(
            $moveCollection->getMoves(),
            fn(PlayerGameScoreCollection $playerGameScoreCollection, Move $move) => $playerGameScoreCollection->addPlayerGameScore(new PlayerGameScore($move->getPlayer(), 0)),
            new PlayerGameScoreCollection(),
        );

        $moves = array_values($moveCollection->getMoves());
        for ($idxMoveOfPlayer = 0; $idxMoveOfPlayer < count($moveCollection->getMoves()); $idxMoveOfPlayer++) {
            $moveOfPlayer = $moves[$idxMoveOfPlayer];
            for ($idxMoveOfCompetitor = $idxMoveOfPlayer + 1; $idxMoveOfCompetitor < count($moveCollection->getMoves()); $idxMoveOfCompetitor++) {
                $moveOfCompetitor = $moves[$idxMoveOfCompetitor];
                $winnerOfTwo      = $this->rules->selectWinnerOfTwo($moveOfPlayer, $moveOfCompetitor);
                $playerGameScoreCollection->findPlayerGameScore($winnerOfTwo)->incrementScore();
            }
        }

        return $playerGameScoreCollection;
    }

    /**
     * @param PlayerGameScoreCollection $playerGameScoreCollection
     *
     * @return PlayerGameScoreGroupedCollection
     */
    public function groupPlayerGameScore(PlayerGameScoreCollection $playerGameScoreCollection): PlayerGameScoreGroupedCollection
    {
        return array_reduce(
            $playerGameScoreCollection->getGameScore(),
            fn(PlayerGameScoreGroupedCollection $layerGameScoreGroupedCollection, PlayerGameScore $playerGameScore) => $layerGameScoreGroupedCollection->addPlayerGameScore($playerGameScore),
            new PlayerGameScoreGroupedCollection(),
        );
    }
}
