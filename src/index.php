<?php declare(strict_types=1);

namespace Game;

use Game\Config\Config;
use Game\View\GameSeriesResultViewFactory;
use Game\View\Renderer;

require 'vendor/autoload.php';

try {
    $app = new App(
        new Config(),
    );

    $controller = new Controller(
        $app,
        new GameSeriesResultViewFactory(),
        new Renderer()
    );

    $controller->showGameSeriesResult();
} catch (\Exception $e){
    echo $e->getMessage();
}
