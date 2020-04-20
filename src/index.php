<?php declare(strict_types=1);

namespace Game;

use Game\Config\Config;
use Game\Item\ItemCollectionFactory;
use Game\Player\PlayerCollectionFactory;
use Game\Player\PlayerStrategyCollectionFactory;
use Game\Player\PlayerStrategyFactory;

require 'vendor/autoload.php';

$config = new Config();

$itemCollectionFactory = new ItemCollectionFactory();
$itemCollection        = $itemCollectionFactory->create($config->getItemNames());

//var_dump($itemCollection->findItem(Config::ITEM_SCISSORS));

$playerStrategyCollectionFactory = new PlayerStrategyCollectionFactory();
$playerStrategyCollection = $playerStrategyCollectionFactory->create($config->getPlayerStrategiesConfig(), $itemCollection);

$playerCollectionFactory = new PlayerCollectionFactory();
$playerCollection = $playerCollectionFactory->create($config->getPlayerStrategiesConfig(), $playerStrategyCollection);

//
//$players = array_map(
//    fn (string $player) => $player->
//    $config->getPlayerNames()
//);
//
//$game = new Game();
//
//echo $game->play();
