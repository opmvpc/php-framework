<?php

use App\Http\Controllers\HomeController;
use PhpFramework\Router\Router;

return $routes = function (Router $router) {
    $router->get('/', [HomeController::class, 'index']);

    $router->get('/articles', function () {
        print 'article';
    });
};
