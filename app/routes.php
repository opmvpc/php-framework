<?php

use PhpFramework\Router\Router;

return $routes = function (Router $router) {
    $router->get('/', function () {
        print 'coucou';
    });

    $router->get('/articles', function () {
        print 'article';
    });
};
