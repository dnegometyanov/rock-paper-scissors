<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Model\Move\Move;
use Game\Model\Move\MoveCollection;

class Game
{
    /**
     * @var PlayerGameplayStrategyCollection
     */
    private PlayerGameplayStrategyCollection $playerGameplayStrategyCollection;

    /**
     * @var Rules
     */
    private Rules $rules;

    public function __construct(
        PlayerGameplayStrategyCollection $playerGameplayStrategyCollection,
        Rules $rules
    )
    {
        $this->playerGameplayStrategyCollection = $playerGameplayStrategyCollection;
        $this->rules                            = $rules;
    }

    public function play()
    {
        /** @var MoveCollection $moves */
        $moveCollection = array_reduce(
            $this->playerGameplayStrategyCollection->getPlayerGameplayStrategies(),
            fn (MoveCollection $moveCollection, PlayerGameplayStrategy $playerGameplayStrategy) =>
                $moveCollection->addMove($playerGameplayStrategy->move()),
            new MoveCollection(),
        );

//        var_dump($moveCollection); exit;

        $result = $this->rankMoves($moveCollection);

        var_dump($result);

        return $result;
    }

    /**
     * @param MoveCollection $moveCollection
     *
     * @return PlayerGameScoreCollection
     */
    public function rankMoves(MoveCollection $moveCollection): PlayerGameScoreCollection
    {
        /** @var PlayerGameScoreCollection $playerGameScoreCollection */
        $playerGameScoreCollection = array_reduce(
            $moveCollection->getMoves(),
            fn(PlayerGameScoreCollection $playerGameScoreCollection, Move $move) =>
                $playerGameScoreCollection->addPlayerGameScore(new PlayerGameScore($move->getPlayer(), 0)),
            new PlayerGameScoreCollection(),
        );

//        var_dump($playerGameScoreCollection); exit;

        $moves = array_values($moveCollection->getMoves());
//        var_dump($moves); exit;
        for ($idxMoveOfPlayer = 0; $idxMoveOfPlayer < count($moveCollection->getMoves()); $idxMoveOfPlayer++) {
            $moveOfPlayer = $moves[$idxMoveOfPlayer];
//            var_dump($moveOfPlayer); exit();
            for ($idxMoveOfCompetitor = $idxMoveOfPlayer + 1; $idxMoveOfCompetitor < count($moveCollection->getMoves()); $idxMoveOfCompetitor++) {
                $moveOfCompetitor = $moves[$idxMoveOfCompetitor];
//                var_dump($moveOfPlayer);
//                var_dump($moveOfCompetitor);
                $winnerOfTwo      = $this->rules->selectWinnerOfTwo($moveOfPlayer, $moveOfCompetitor);
                $playerGameScoreCollection->findPlayerGameScore($winnerOfTwo)->incrementScore();
            }
        }

        return $playerGameScoreCollection;
    }
}
