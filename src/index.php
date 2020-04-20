<?php declare(strict_types=1);

namespace Game;

use Game\Config\Config;
use Game\Gameplay\GameplayStrategy\GameplayStrategyFactory;
use Game\Model\MoveOption\MoveOptionCollectionFactory;
use Game\Model\Player\PlayerCollectionFactory;
use Game\Model\Player\PlayerFactory;

require 'vendor/autoload.php';

$config = new Config();

$itemCollectionFactory = new MoveOptionCollectionFactory();
$itemCollection        = $itemCollectionFactory->create($config->getItemNames());

//var_dump($itemCollection->findItem(Config::ITEM_SCISSORS));

$playerFactory           = new PlayerFactory();
$playerStrategyFactory   = new GameplayStrategyFactory();
$playerCollectionFactory = new PlayerCollectionFactory($playerFactory, $playerStrategyFactory);
$playerCollection        = $playerCollectionFactory->create($config->getPlayerStrategiesConfig(), $itemCollection);

var_dump($playerCollection->findPlayer(Config::PLAYER_A));

//$playerCollectionFactory = new PlayerOldCollectionFactory();
//$playerCollection = $playerCollectionFactory->create($config->getPlayerStrategiesConfig(), $playerStrategyCollection);

//
//$players = array_map(
//    fn (string $player) => $player->
//    $config->getPlayerNames()
//);
//
//$game = new Game();
//
//echo $game->play();
