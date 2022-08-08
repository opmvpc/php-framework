<?php

namespace App;

use PhpFramework\Router\Router;

class App {
    public static function run() {
        $router = new Router();

        // routes registering
        $routes = require_once __DIR__ . './routes.php';
        $routes($router);

        print $router->dispatch();
    }
}