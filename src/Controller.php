<?php declare(strict_types=1);

namespace Game;

use Game\View\GameSeriesResultViewFactory;
use Game\View\Renderer;

class Controller
{
    /**
     * @var App
     */
    private App $app;

    /**
     * @var Renderer
     */
    private Renderer $renderer;
    /**
     * @var GameSeriesResultViewFactory
     */
    private GameSeriesResultViewFactory $viewFactory;

    /**
     * App constructor.
     *
     * @param App $app
     * @param GameSeriesResultViewFactory $viewFactory
     * @param Renderer $renderer
     */
    public function __construct(
        App $app,
        GameSeriesResultViewFactory $viewFactory,
        Renderer $renderer
    )
    {
        $this->app         = $app;
        $this->viewFactory = $viewFactory;
        $this->renderer    = $renderer;
    }

    public function showGameSeriesResult(): string {
        $gameSeriesResult = $this->app->runGameSeries();
        $output           = $this->viewFactory->createView($gameSeriesResult)->view($gameSeriesResult);

        $this->renderer->render($output);

        return $output;
    }
}
