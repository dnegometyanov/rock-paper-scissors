<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Model\MoveOption\MoveOption;
use Game\Model\Player\Player;

class GameScore
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

    public function addPlayerGameScore(PlayerGameScore $playerGameScore): void
    {
        $this->gameScore[$playerGameScore->getPlayer()->getName()] = $playerGameScore;
    }

    public function findPlayerGameScore(Player $player): PlayerGameScore
    {
        return $this->gameScore[$player->getName()];
    }

    /**
     * @return array
     */
    public function getGameScore(): array
    {
        return $this->gameScore;
    }
}
