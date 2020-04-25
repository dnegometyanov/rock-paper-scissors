<?php declare(strict_types=1);

namespace Game\Service;

use Game\Model\Move\Move;
use Game\Model\Player\Player;

class RulesService
{
    /**
     * @var array
     */
    private array $rulesItemBeatConfig;

    public function __construct(array $rulesMoveOptionBeatConfig)
    {
        $this->rulesItemBeatConfig = $rulesMoveOptionBeatConfig;
    }

    /**
     * @param Move $moveOfPlayer
     * @param Move $moveOfCompetitor
     *
     * @return Player|null
     */
    public function selectWinnerOfTwo(Move $moveOfPlayer, Move $moveOfCompetitor): ?Player
    {
        $playerItemName     = $moveOfPlayer->getMoveOption()->getName();
        $competitorItemName = $moveOfCompetitor->getMoveOption()->getName();

        if (in_array($competitorItemName, $this->rulesItemBeatConfig[$playerItemName])) {
            return $moveOfPlayer->getPlayer();
        } elseif (in_array($playerItemName, $this->rulesItemBeatConfig[$competitorItemName])) {
            return $moveOfCompetitor->getPlayer();
        }

        return null;
    }
}
