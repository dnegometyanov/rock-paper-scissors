<?php declare(strict_types=1);

namespace Game;

use Game\Config\Config;
use Game\Model\GameplayStrategy\GameplayStrategyCollectionFactory;
use Game\Model\GameplayStrategy\GameplayStrategyFactory;
use Game\Model\MoveOption\MoveOptionCollectionFactory;
use Game\Model\Player\PlayerCollectionFactory;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategyCollectionFactory;
use Game\Service\GameplayStrategyService\GameplayStrategyServiceFactory;
use Game\Service\GameSeriesService;
use Game\Service\GameService;
use Game\Service\RulesService;

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
$playerGameplayStrategyCollection        = $playerGameplayStrategyCollectionFactory->createPlayerGameplayStrategyCollection();

//var_dump($playerGameplayStrategyCollection); exit;

$gameplayStrategyServiceFactory = new GameplayStrategyServiceFactory($moveOptionCollection);
$rulesService                   = new RulesService($config->getRulesMoveOptionBeatConfig());
$gameService                    = new GameService($gameplayStrategyServiceFactory, $playerGameplayStrategyCollection, $rulesService);

//$result                         = $game->play();
//var_dump($result);

$gameSeriesService = new GameSeriesService($gameService, $config->getGameSeriesConfig());

$result = $gameSeriesService->playSeries();
var_dump($result);
