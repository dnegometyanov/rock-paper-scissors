<?php declare(strict_types=1);

namespace Game\View;

class Renderer
{
    public function render(string $output): void
    {
        echo $output;
    }
}
