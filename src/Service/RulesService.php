<?php declare(strict_types=1);

namespace Game\Service;

use Game\Model\Move\Move;
use Game\Model\Player\Player;

class RulesService
{
    /**
     * @var array
     */
    private array $rulesMoveOptionsBeatConfig;

    public function __construct(array $rulesMoveOptionBeatConfig)
    {
        $this->rulesMoveOptionsBeatConfig = $rulesMoveOptionBeatConfig;
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

        if (in_array($competitorItemName, $this->rulesMoveOptionsBeatConfig[$playerItemName])) {
            return $moveOfPlayer->getPlayer();
        } elseif (in_array($playerItemName, $this->rulesMoveOptionsBeatConfig[$competitorItemName])) {
            return $moveOfCompetitor->getPlayer();
        }

        return null;
    }
}
