<?php

use PhpFramework\Router\Router;

return $routes = function (Router $router) {
    $router->get('/', function () {
        echo('test home');
    });
};