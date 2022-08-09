<?php

namespace App;

use PhpFramework\Router\Router;

class App
{
    public static function run()
    {
        $router = new Router();

        // routes registering
        $registerRoutes = require_once __DIR__ . '/registerRoutes.php';
        $registerRoutes($router);

        $router->dispatch();
    }
}
