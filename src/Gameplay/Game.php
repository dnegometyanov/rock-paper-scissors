<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Model\Move;
use Game\Model\Player\Player;

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

    public function play(): array
    {
        /** @var Move[] $moves */
        $moves = array_map(
            fn (PlayerGameplayStrategy $playerGameplayStrategy) => $playerGameplayStrategy->move(),
            $this->playerGameplayStrategyCollection->getPlayerGameplayStrategies(),
        );

        return $moves;
    }

    /**
     * @param Move[] $moves
     *
     * @return Player[]
     */
    public function rankPlayers(array $moves): array
    {
        /** @var GameScore $gameScore */
        $gameScore = array_reduce(
            $moves,
            fn(GameScore $gameScore, Move $move) => $gameScore->addPlayerGameScore(new PlayerGameScore($move->getPlayer(), 0, count($moves))),
            new GameScore(),
        );

        for ($idxMoveOfPlayer = 0; $idxMoveOfPlayer < count($moves); $idxMoveOfPlayer++) {
            $moveOfPlayer = $moves[$idxMoveOfPlayer];
            for ($idxMoveOfCompetitor = $idxMoveOfPlayer + 1; $idxMoveOfCompetitor < count($moves); $idxMoveOfCompetitor++) {
                $moveOfCompetitor = $moves[$idxMoveOfCompetitor];
                $winnerOfTwo      = $this->rules->selectWinnerOfTwo($moveOfPlayer, $moveOfCompetitor);
                $gameScore->findPlayerGameScore($winnerOfTwo)->incrementScore();
            }
        }
    }
}
