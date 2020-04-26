<?php declare(strict_types=1);

namespace Game\Config;

interface ConfigInterface {
    public function getMoveOptionNamesConfig(): array;

    public function getRulesMoveOptionBeatConfig(): array;

    public function getPlayerNamesConfig() :array;

    public function getStrategiesConfig(): array;

    public function getPlayerStrategiesConfig(): array;

    public function getGameSeriesConfig(): array;
}
