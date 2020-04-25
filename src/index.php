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
use Game\View\GameSeriesResultView;

require 'vendor/autoload.php';

$config = new Config();

$moveOptionCollectionFactory = new MoveOptionCollectionFactory();
$moveOptionCollection        = $moveOptionCollectionFactory->create($config->getMoveOptionNamesConfig());

$playerCollectionFactory = new PlayerCollectionFactory();
$playerCollection        = $playerCollectionFactory->create($config->getPlayerNamesConfig());

$gameplayStrategyFactory = new GameplayStrategyFactory($moveOptionCollection);

$gameplayStrategyCollectionFactory = new GameplayStrategyCollectionFactory(
    $gameplayStrategyFactory,
    $moveOptionCollection,
);

$gameplayStrategyCollection = $gameplayStrategyCollectionFactory->createGameplayStrategyCollection(
    $config->getStrategiesConfig()
);

$playerGameplayStrategyCollectionFactory = new PlayerGameplayStrategyCollectionFactory(
    $playerCollection,
    $gameplayStrategyCollection,
    $config->getPlayerStrategiesConfig()
);
$playerGameplayStrategyCollection        = $playerGameplayStrategyCollectionFactory->createPlayerGameplayStrategyCollection();

$gameplayStrategyServiceFactory = new GameplayStrategyServiceFactory($moveOptionCollection);
$rulesService                   = new RulesService($config->getRulesMoveOptionBeatConfig());
$gameService                    = new GameService($gameplayStrategyServiceFactory, $playerGameplayStrategyCollection, $rulesService);

$gameSeriesService = new GameSeriesService($gameService, $config->getGameSeriesConfig());

$gameSeriesResult = $gameSeriesService->playSeries();
//var_dump($gameSeriesResult); exit;

$gameSeriesResultView = new GameSeriesResultView();

echo $gameSeriesResultView->view($gameSeriesResult);
