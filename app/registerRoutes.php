<?php

use App\Http\Controllers\HomeController;
use PhpFramework\Router\Router;

return $registerRoutes = function (Router $router) {
    $router->get('/', [HomeController::class, 'index']);

    $router->get('/articles', fn () => print 'article');
};
