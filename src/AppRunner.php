<?php declare(strict_types=1);

namespace Game;

use Game\View\GameSeriesResultViewFactory;
use Game\View\Renderer;

class AppRunner
{
    public function run():void
    {
        try {
            $shortOps = 'c::';

            $longOpts = [
                'config::',
            ];

            $options = getopt($shortOps, $longOpts);

            $configClassName = empty($options['config'])
                ? 'Game\Config\Config'
                : sprintf('Game\Config\%s', $options['config']);

            $app = new App(new $configClassName);

            $controller = new Controller(
                $app,
                new GameSeriesResultViewFactory(),
                new Renderer()
            );

            $controller->showGameSeriesResult();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
