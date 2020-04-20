<?php declare(strict_types=1);

namespace Game\Model\Player;


class Player
{
    /**
     * @var string
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name           = $name;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
}
