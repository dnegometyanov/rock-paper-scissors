<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Model\Player\Player;
use Game\Model\Player\Player;

class Rules
{
    private array $rulesItemBeat;

    public function __construct(array $rulesItemBeat)
    {
        $this->rulesItemBeat = $rulesItemBeat;
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
                $winnerOfTwo      = $this->selectWinnerOfTwo($moveOfPlayer, $moveOfCompetitor);
                $gameScore->findPlayerGameScore($winnerOfTwo)->incrementScore();
            }
        }
    }

    public function selectWinnerOfTwo(Move $moveOfPlayer, Move $moveOfCompetitor): Player
    {
        $playerItemName     = $moveOfPlayer->getMoveOption()->getName();
        $competitorItemName = $moveOfCompetitor->getMoveOption()->getName();
        if (in_array($competitorItemName, $this->rulesItemBeat[$playerItemName])) {
            return $moveOfPlayer->getPlayer();
        }

        return $moveOfCompetitor->getPlayer();
    }
}
