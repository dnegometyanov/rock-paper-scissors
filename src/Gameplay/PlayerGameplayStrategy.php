<?php declare(strict_types=1);

namespace Game\Gameplay;

use Game\Gameplay\GameplayStrategy\GameplayStrategyInterface;
use Game\Model\Move\Move;
use Game\Model\Player\Player;

class PlayerGameplayStrategy
{
    /**
     * @var Player
     */
    private Player $player;

    /**
     * @var GameplayStrategyInterface
     */
    private GameplayStrategyInterface $gameplayStrategy;

    public function __construct(Player $player, GameplayStrategyInterface $gameplayStrategy)
    {
        $this->player           = $player;
        $this->gameplayStrategy = $gameplayStrategy;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @return GameplayStrategyInterface
     */
    public function getGameplayStrategy(): GameplayStrategyInterface {
        return $this->gameplayStrategy;
    }


    /**
     * @return Move
     */
    public function move(): Move
    {
        return new Move(
            $this->player,
            $this->gameplayStrategy->selectMoveOption(),
        );
    }
}
