<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Model\Move\Move;
use Game\Model\Player\Player;

class Rules
{
    private array $rulesItemBeatConfig;

    public function __construct(array $rulesMoveOptionBeatConfig)
    {
        $this->rulesItemBeatConfig = $rulesMoveOptionBeatConfig;
    }

    public function selectWinnerOfTwo(Move $moveOfPlayer, Move $moveOfCompetitor): Player
    {
        $playerItemName     = $moveOfPlayer->getMoveOption()->getName();
        $competitorItemName = $moveOfCompetitor->getMoveOption()->getName();
        if (in_array($competitorItemName, $this->rulesItemBeatConfig[$playerItemName])) {
            return $moveOfPlayer->getPlayer();
        }

        return $moveOfCompetitor->getPlayer();
    }
}
