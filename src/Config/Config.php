<?php declare(strict_types=1);

namespace Game\Config;

class Config
{
    const ITEM_ROCK     = 'Rock';
    const ITEM_PAPER    = 'Paper';
    const ITEM_SCISSORS = 'Scissors';

    const ITEMS = [
        self::ITEM_ROCK,
        self::ITEM_PAPER,
        self::ITEM_SCISSORS,
    ];

    const RULES_ITEMS_BEAT = [
        self::ITEM_ROCK => [
            self::ITEM_SCISSORS,
        ],
        self::ITEM_PAPER => [
            self::ITEM_ROCK,
        ],
        self::ITEM_SCISSORS => [
            self::ITEM_PAPER,
        ],
    ];

    const PLAYER_A = 'Player A';
    const PLAYER_B = 'Player B';

    const PLAYERS = [
        self::PLAYER_A,
        self::PLAYER_B,
    ];

    const STRATEGY_PROBABILITY = 'strategy-probability';

    const STRATEGY_PROBABILITY_ALWAYS_PAPER_CONFIG = [
        self::ITEM_ROCK     => 0,
        self::ITEM_PAPER    => 100,
        self::ITEM_SCISSORS => 0,
    ];

    const STRATEGY_PROBABILITY_RANDOM_CONFIG = [
        self::ITEM_ROCK     => 33,
        self::ITEM_PAPER    => 33,
        self::ITEM_SCISSORS => 33,
    ];

    const PLAYER_STRATEGIES = [
        self::PLAYER_A => [
            'strategy_name'   => self::STRATEGY_PROBABILITY,
            'strategy_config' => self::STRATEGY_PROBABILITY_ALWAYS_PAPER_CONFIG,
        ],
        self::PLAYER_B => [
            'strategy_name'   => self::STRATEGY_PROBABILITY,
            'strategy_config' => self::STRATEGY_PROBABILITY_RANDOM_CONFIG,
        ]
    ];

    public function getItemNames() :array
    {
        return self::ITEMS;
    }

    public function getPlayerNames() :array
    {
        return self::PLAYERS;
    }

    public function getPlayerStrategiesConfig() :array
    {
        return self::PLAYER_STRATEGIES;
    }
}
