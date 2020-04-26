<?php declare(strict_types=1);

namespace Game;

use Game\Config\Config;

require 'vendor/autoload.php';

try {
    $app = new App(new Config());
    $app->run();
} catch (\Exception $e){
    echo $e->getMessage();
}
