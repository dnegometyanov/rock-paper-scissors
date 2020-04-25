<?php declare(strict_types=1);

namespace Game\Model\GameSeriesResult;

use Game\Model\Player\Player;

class PlayerGameSeriesScoreCollection
{
    /**
     * @var PlayerGameSeriesScore[]
     */
    private array $playersGameSeriesScore;

    public function __construct()
    {
        $this->playersGameSeriesScore = [];
    }

    /**
     * @param PlayerGameSeriesScore $playerGameSeriesScore
     *
     * @return PlayerGameSeriesScoreCollection
     */
    public function addPlayerGameSeriesScore(PlayerGameSeriesScore $playerGameSeriesScore): PlayerGameSeriesScoreCollection
    {
        $this->playersGameSeriesScore[$playerGameSeriesScore->getPlayer()->getName()] = $playerGameSeriesScore;

        return $this;
    }

    /**
     * @param Player $player
     *
     * @return PlayerGameSeriesScore|null
     */
    public function findPlayerGameSeriesScore(Player $player): ?PlayerGameSeriesScore
    {
        return $this->playersGameSeriesScore[$player->getName()] ?: null;
    }

    public function toArray(): array
    {
        return $this->playersGameSeriesScore;
    }
}
