<?php declare(strict_types=1);

namespace Game;

use Game\Config\Config;
use Game\Gameplay\Game;
use Game\Gameplay\GameplayStrategy\GameplayStrategyCollectionFactory;
use Game\Gameplay\GameplayStrategy\GameplayStrategyFactory;
use Game\Gameplay\PlayerGameplayStrategy\PlayerGameplayStrategyCollectionFactory;
use Game\Gameplay\Rules;
use Game\Model\MoveOption\MoveOptionCollectionFactory;
use Game\Model\Player\PlayerCollectionFactory;

require 'vendor/autoload.php';

$config = new Config();

$moveOptionCollectionFactory = new MoveOptionCollectionFactory();
$moveOptionCollection        = $moveOptionCollectionFactory->create($config->getMoveOptionNamesConfig());

//var_dump($itemCollection->findItem(Config::ITEM_SCISSORS));

$playerCollectionFactory = new PlayerCollectionFactory();
$playerCollection        = $playerCollectionFactory->create($config->getPlayerNamesConfig());

$gameplayStrategyFactory = new GameplayStrategyFactory($moveOptionCollection);

$gameplayStrategyCollectionFactory = new GameplayStrategyCollectionFactory(
    $gameplayStrategyFactory,
    $moveOptionCollection,
);

//var_dump($config->getStrategiesConfig()); exit;

$gameplayStrategyCollection = $gameplayStrategyCollectionFactory->createGameplayStrategyCollection(
    $config->getStrategiesConfig()
);

//var_dump($gameplayStrategyCollection); exit;

$playerGameplayStrategyCollectionFactory = new PlayerGameplayStrategyCollectionFactory(
    $playerCollection,
    $gameplayStrategyCollection,
    $config->getPlayerStrategiesConfig()
);
$playerGameplayStrategyCollection = $playerGameplayStrategyCollectionFactory->createPlayerGameplayStrategyCollection();

//var_dump($playerGameplayStrategyCollection); exit;

$rules  = new Rules($config->getRulesMoveOptionBeatConfig());
$game   = new Game($playerGameplayStrategyCollection, $rules);
$result = $game->play();

var_dump($result);

//
//$players = array_map(
//    fn (string $player) => $player->
//    $config->getPlayerNames()
//);
//
//$game = new Game();
//
//echo $game->play();
