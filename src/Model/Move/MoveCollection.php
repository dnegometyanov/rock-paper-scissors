<?php declare(strict_types=1);

namespace Game\Model\Move;

class MoveCollection
{
    /**
     * @var Move[]
     */
    private array $moves;

    public function __construct()
    {
        $this->moves = [];
    }

    public function addMove(Move $move): MoveCollection
    {
        $this->moves[$move->getPlayer()->getName()] = $move;

        return $this;
    }

    /**
     * @param string $playerName
     *
     * @return Move
     */
    public function findMove(string $playerName): Move
    {
        return $this->moves[$playerName];
    }

    /**
     * @return Move[]
     */
    public function toArray(): array
    {
        return $this->moves;
    }
}
