<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Model\MoveOption\MoveOptionInterface;
use Game\Model\Player\PlayerInterface;

class GameScore
{
    private array $gameScore;

    public function __construct()
    {
        $this->gameScore = [];
    }

    /**
     * @var MoveOptionInterface
     */
    private MoveOptionInterface $item;

    public function addPlayerGameScore(PlayerGameScore $playerGameScore): void
    {
        $this->gameScore[$playerGameScore->getPlayer()->getName()] = $playerGameScore;
    }

    public function findPlayerGameScore(PlayerInterface $player): PlayerGameScore
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
