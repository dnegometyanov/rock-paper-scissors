<?php declare(strict_types=1);

namespace Game;

use Game\Config\ConfigInterface;
use Game\Model\GameplayStrategy\GameplayStrategyCollectionFactory;
use Game\Model\GameplayStrategy\GameplayStrategyFactory;
use Game\Model\GameSeriesResult\GameSeriesResult;
use Game\Model\MoveOption\MoveOptionCollectionFactory;
use Game\Model\Player\PlayerCollectionFactory;
use Game\Model\PlayerGameplayStrategy\PlayerGameplayStrategyCollectionFactory;
use Game\Service\GameplayStrategyService\GameplayStrategyServiceFactory;
use Game\Service\GameSeriesService;
use Game\Service\GameService;
use Game\Service\RulesService;

class App
{
    /**
     * @var ConfigInterface
     */
    private ConfigInterface $config;

    public function __construct(
        ConfigInterface $config
    )
    {
        $this->config = $config;
    }

    public function runGameSeries(): GameSeriesResult
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

        return $gameSeriesService->playSeries();
    }
}
