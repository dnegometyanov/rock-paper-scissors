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

class App
{
    /**
     * @var Config
     */
    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function run(): void
    {
        $moveOptionCollectionFactory = new MoveOptionCollectionFactory();
        $moveOptionCollection        = $moveOptionCollectionFactory->create($this->config->getMoveOptionNamesConfig());

        $playerCollectionFactory = new PlayerCollectionFactory();
        $playerCollection        = $playerCollectionFactory->create($this->config->getPlayerNamesConfig());

        $gameplayStrategyFactory = new GameplayStrategyFactory($moveOptionCollection);

        $gameplayStrategyCollectionFactory = new GameplayStrategyCollectionFactory(
            $gameplayStrategyFactory,
            $moveOptionCollection,
        );

        $gameplayStrategyCollection = $gameplayStrategyCollectionFactory->createGameplayStrategyCollection(
            $this->config->getStrategiesConfig()
        );

        $playerGameplayStrategyCollectionFactory = new PlayerGameplayStrategyCollectionFactory(
            $playerCollection,
            $gameplayStrategyCollection,
            $this->config->getPlayerStrategiesConfig()
        );
        $playerGameplayStrategyCollection        = $playerGameplayStrategyCollectionFactory->createPlayerGameplayStrategyCollection();

        $gameplayStrategyServiceFactory = new GameplayStrategyServiceFactory($moveOptionCollection);
        $rulesService                   = new RulesService($this->config->getRulesMoveOptionBeatConfig());
        $gameService                    = new GameService($gameplayStrategyServiceFactory, $playerGameplayStrategyCollection, $rulesService);

        $gameSeriesService = new GameSeriesService($gameService, $this->config->getGameSeriesConfig());

        $gameSeriesResult = $gameSeriesService->playSeries();

        $gameSeriesResultView = new GameSeriesResultView();
        echo $gameSeriesResultView->view($gameSeriesResult);
    }
}
