<?php declare(strict_types=1);

namespace Game\Model\PlayerGameScore;

use Game\Model\MoveOption\MoveOption;
use Game\Model\Player\Player;

class PlayerGameScoreCollection
{
    private array $gameScore;

    public function __construct()
    {
        $this->gameScore = [];
    }

    /**
     * @var MoveOption
     */
    private MoveOption $item;

    public function addPlayerGameScore(PlayerGameScore $playerGameScore): PlayerGameScoreCollection
    {
        $this->gameScore[$playerGameScore->getPlayer()->getName()] = $playerGameScore;

        return $this;
    }

    /**
     * @return array
     */
    public function getGameScore(): array
    {
        return $this->gameScore;
    }

    public function findPlayerGameScore(Player $player): PlayerGameScore
    {
        return $this->gameScore[$player->getName()];
    }
}
