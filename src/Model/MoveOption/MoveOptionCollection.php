<?php declare(strict_types=1);

namespace Game\Model\MoveOption;

class MoveOptionCollection
{
    /**
     * @var array
     */
    private array $moveOptions;

    public function __construct()
    {
        $this->moveOptions = [];
    }

    public function addMoveOption(MoveOption $moveOption): MoveOptionCollection
    {
        $this->moveOptions[$moveOption->getName()] = $moveOption;

        return $this;
    }

    /**
     * @return MoveOption[]
     */
    public function getMoveOptions(): array
    {
        return $this->moveOptions;
    }

    /**
     * @param string $moveOptionName
     *
     * @return MoveOption
     */
    public function findMoveOption(string $moveOptionName): MoveOption
    {
        return $this->moveOptions[$moveOptionName];
    }
}
