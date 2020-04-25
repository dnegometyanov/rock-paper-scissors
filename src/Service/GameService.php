<?php declare(strict_types=1);

namespace Game\Service;

use Game\Model\Move\Move;
use Game\Model\Move\MoveCollection;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategy;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategyCollection;
use Game\Model\PlayerGameScore\PlayerGameScore;
use Game\Model\PlayerGameScore\PlayerGameScoreCollection;
use Game\Model\PlayerGameScore\PlayerGameScoreGroupedRankedCollection;
use Game\Model\PlayerGameScore\PlayerGameScoreGroupedSortedCollection;
use Game\Service\GameplayStrategyService\GameplayStrategyServiceFactory;

class GameService
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
     * @var RulesService
     */
    private RulesService $rules;

    public function __construct(
        GameplayStrategyServiceFactory $gameplayStrategyServiceFactory,
        PlayerGameplayStrategyCollection $playerGameplayStrategyCollection,
        RulesService $rules
    )
    {
        $this->gameplayStrategyServiceFactory   = $gameplayStrategyServiceFactory;
        $this->playerGameplayStrategyCollection = $playerGameplayStrategyCollection;
        $this->rules                            = $rules;
    }

    public function play(): PlayerGameScoreGroupedRankedCollection
    {
        $moveCollection                         = $this->getPlayerMoves();
        $playerGameScoreCollection              = $this->calculatePlayerGameScoreScore($moveCollection);
        $playerGameScoreGroupedSortedCollection = $this->groupAndSortPlayerGameScore($playerGameScoreCollection);

        return new PlayerGameScoreGroupedRankedCollection($playerGameScoreGroupedSortedCollection);
    }

    protected function getPlayerMoves(): MoveCollection
    {
        return array_reduce(
            $this->playerGameplayStrategyCollection->toArray(),
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
    protected function calculatePlayerGameScoreScore(MoveCollection $moveCollection): PlayerGameScoreCollection
    {
        /** @var PlayerGameScoreCollection $playerGameScoreCollection */
        $playerGameScoreCollection = array_reduce(
            $moveCollection->toArray(),
            fn(PlayerGameScoreCollection $playerGameScoreCollection, Move $move) => $playerGameScoreCollection->addPlayerGameScore(new PlayerGameScore($move, 0)),
            new PlayerGameScoreCollection(),
        );

        $moves = array_values($moveCollection->toArray());
        for ($idxMoveOfPlayer = 0; $idxMoveOfPlayer < count($moveCollection->toArray()); $idxMoveOfPlayer++) {
            $moveOfPlayer = $moves[$idxMoveOfPlayer];
            for ($idxMoveOfCompetitor = $idxMoveOfPlayer + 1; $idxMoveOfCompetitor < count($moveCollection->toArray()); $idxMoveOfCompetitor++) {
                $moveOfCompetitor = $moves[$idxMoveOfCompetitor];
                $winnerOfTwo      = $this->rules->selectWinnerOfTwo($moveOfPlayer, $moveOfCompetitor);
                if ($winnerOfTwo) {
                    $playerGameScoreCollection->findPlayerGameScore($winnerOfTwo)->incrementScore();
                }
            }
        }

        return $playerGameScoreCollection;
    }

    /**
     * @param PlayerGameScoreCollection $playerGameScoreCollection
     *
     * @return PlayerGameScoreGroupedSortedCollection
     */
    protected function groupAndSortPlayerGameScore(PlayerGameScoreCollection $playerGameScoreCollection): PlayerGameScoreGroupedSortedCollection
    {
        return array_reduce(
            $playerGameScoreCollection->getGameScore(),
            fn(PlayerGameScoreGroupedSortedCollection $layerGameScoreGroupedCollection, PlayerGameScore $playerGameScore) => $layerGameScoreGroupedCollection->addPlayerGameScore($playerGameScore),
            new PlayerGameScoreGroupedSortedCollection(),
        );
    }
}
