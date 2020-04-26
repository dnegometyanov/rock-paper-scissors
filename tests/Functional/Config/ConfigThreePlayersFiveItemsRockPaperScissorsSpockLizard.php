<?php declare(strict_types=1);

namespace GameTest\Functional\Config;

use Game\Config\ConfigInterface;

class ConfigThreePlayersFiveItemsRockPaperScissorsSpockLizard implements ConfigInterface
{
    const MOVE_OPTION_ROCK     = 'Rock';
    const MOVE_OPTION_PAPER    = 'Paper';
    const MOVE_OPTION_SCISSORS = 'Scissors';
    const MOVE_OPTION_SPOCK    = 'Spock';
    const MOVE_OPTION_LIZARD   = 'Lizard';

    const MOVE_OPTIONS = [
        self::MOVE_OPTION_ROCK,
        self::MOVE_OPTION_PAPER,
        self::MOVE_OPTION_SCISSORS,
        self::MOVE_OPTION_SPOCK,
        self::MOVE_OPTION_LIZARD,
    ];

    const RULES_MOVE_OPTION_BEAT = [
        self::MOVE_OPTION_ROCK => [
            self::MOVE_OPTION_SCISSORS,
            self::MOVE_OPTION_LIZARD,
        ],
        self::MOVE_OPTION_PAPER => [
            self::MOVE_OPTION_ROCK,
            self::MOVE_OPTION_SPOCK,
        ],
        self::MOVE_OPTION_SCISSORS => [
            self::MOVE_OPTION_PAPER,
            self::MOVE_OPTION_LIZARD,
        ],
        self::MOVE_OPTION_SPOCK => [
            self::MOVE_OPTION_SCISSORS,
            self::MOVE_OPTION_ROCK,
        ],
        self::MOVE_OPTION_LIZARD => [
            self::MOVE_OPTION_PAPER,
            self::MOVE_OPTION_SPOCK,
        ],
    ];

    const PLAYER_A = 'Player A';
    const PLAYER_B = 'Player B';
    const PLAYER_C = 'Player C';

    const PLAYERS = [
        self::PLAYER_A,
        self::PLAYER_B,
        self::PLAYER_C,
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
            self::MOVE_OPTION_SPOCK    => 0,
            self::MOVE_OPTION_LIZARD   => 0,
        ]
    ];

    const STRATEGY_NAME_PROBABILITY_ALWAYS_SPOCK = 'probability-always-spock';

    const STRATEGY_PROBABILITY_ALWAYS_SPOCK = [
        'strategy_name'   => self::STRATEGY_NAME_PROBABILITY_ALWAYS_SPOCK,
        'strategy_type'   => self::STRATEGY_TYPE_PROBABILITY,
        'strategy_config' => [
            self::MOVE_OPTION_ROCK     => 0,
            self::MOVE_OPTION_PAPER    => 0,
            self::MOVE_OPTION_SCISSORS => 0,
            self::MOVE_OPTION_SPOCK    => 100,
            self::MOVE_OPTION_LIZARD   => 0,
        ]
    ];

    const STRATEGY_NAME_PROBABILITY_ALWAYS_LIZARD = 'probability-always-lizard';

    const STRATEGY_PROBABILITY_ALWAYS_LIZARD = [
        'strategy_name'   => self::STRATEGY_NAME_PROBABILITY_ALWAYS_LIZARD,
        'strategy_type'   => self::STRATEGY_TYPE_PROBABILITY,
        'strategy_config' => [
            self::MOVE_OPTION_ROCK     => 0,
            self::MOVE_OPTION_PAPER    => 0,
            self::MOVE_OPTION_SCISSORS => 0,
            self::MOVE_OPTION_SPOCK    => 0,
            self::MOVE_OPTION_LIZARD   => 100,
        ]
    ];

    const STRATEGIES = [
        self::STRATEGY_PROBABILITY_ALWAYS_PAPER,
        self::STRATEGY_PROBABILITY_ALWAYS_SPOCK,
        self::STRATEGY_PROBABILITY_ALWAYS_LIZARD,
    ];

    const PLAYER_STRATEGIES = [
        self::PLAYER_A => self::STRATEGY_NAME_PROBABILITY_ALWAYS_PAPER,
        self::PLAYER_B => self::STRATEGY_NAME_PROBABILITY_ALWAYS_SPOCK,
        self::PLAYER_C => self::STRATEGY_NAME_PROBABILITY_ALWAYS_LIZARD,
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
