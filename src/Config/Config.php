<?php declare(strict_types=1);

namespace Game\Config;

class Config implements ConfigInterface
{
    const MOVE_OPTION_ROCK     = 'Rock';
    const MOVE_OPTION_PAPER    = 'Paper';
    const MOVE_OPTION_SCISSORS = 'Scissors';

    const MOVE_OPTIONS = [
        self::MOVE_OPTION_ROCK,
        self::MOVE_OPTION_PAPER,
        self::MOVE_OPTION_SCISSORS,
    ];

    const RULES_MOVE_OPTION_BEAT = [
        self::MOVE_OPTION_ROCK => [
            self::MOVE_OPTION_SCISSORS,
        ],
        self::MOVE_OPTION_PAPER => [
            self::MOVE_OPTION_ROCK,
        ],
        self::MOVE_OPTION_SCISSORS => [
            self::MOVE_OPTION_PAPER,
        ],
    ];

    const PLAYER_A = 'Player A';
    const PLAYER_B = 'Player B';

    const PLAYERS = [
        self::PLAYER_A,
        self::PLAYER_B,
    ];

    const STRATEGY_TYPE_PROBABILITY = 'strategy-probability';

    const STRATEGY_NAME_PROBABILITY_ALWAYS_PAPER = 'probability-always-paper';

    const STRATEGY_PROBABILITY_ALWAYS_PAPER = [
        'strategy_name'   => self::STRATEGY_NAME_PROBABILITY_ALWAYS_PAPER,
        'strategy_type'   => self::STRATEGY_TYPE_PROBABILITY,
        'strategy_config' => [
            self::MOVE_OPTION_ROCK     => 0,
            self::MOVE_OPTION_PAPER    => 100,
            self::MOVE_OPTION_SCISSORS => 0,
        ]
    ];

    const STRATEGY_NAME_PROBABILITY_RANDOM = 'probability-random';

    const STRATEGY_PROBABILITY_RANDOM = [
        'strategy_name'   => self::STRATEGY_NAME_PROBABILITY_RANDOM,
        'strategy_type'   => self::STRATEGY_TYPE_PROBABILITY,
        'strategy_config' => [
            self::MOVE_OPTION_ROCK     => 33,
            self::MOVE_OPTION_PAPER    => 33,
            self::MOVE_OPTION_SCISSORS => 33,
        ]
    ];

    const STRATEGIES = [
        self::STRATEGY_PROBABILITY_ALWAYS_PAPER,
        self::STRATEGY_PROBABILITY_RANDOM,
    ];

    const PLAYER_STRATEGIES = [
        self::PLAYER_A => self::STRATEGY_NAME_PROBABILITY_ALWAYS_PAPER,
        self::PLAYER_B => self::STRATEGY_NAME_PROBABILITY_RANDOM,
    ];

    const GAME_SERIES_GAMES_NUMBER = 100;

    public function getMoveOptionNamesConfig(): array
    {
        return self::MOVE_OPTIONS;
    }

    public function getRulesMoveOptionBeatConfig(): array
    {
        return self::RULES_MOVE_OPTION_BEAT;
    }

    public function getPlayerNamesConfig() :array
    {
        return self::PLAYERS;
    }

    public function getStrategiesConfig(): array
    {
        return self::STRATEGIES;
    }

    public function getPlayerStrategiesConfig(): array
    {
        return self::PLAYER_STRATEGIES;
    }

    public function getGameSeriesConfig(): array
    {
        return [
            'game_series_games_number' => self::GAME_SERIES_GAMES_NUMBER,
        ];
    }
}
