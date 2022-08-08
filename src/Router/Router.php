<?php

namespace PhpFramework\Router;

class Router {
    protected array $routes;
    protected Route $current;

    public function __construct() {
        $this->paths = [];
        $this->current = null;
    }

    public function get(string $path, $action) {
        $this->routes[$path] = Route::get($path, $action);
    }

    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $requestPath = $_SERVER['REQUEST_URI'] ?? '/';

        $matching = $this->match($requestMethod, $requestPath);
        if ($matching) {
            try {
                $matching->run();               
            } catch (\Throwable $th) {
                $this->dispatchError($th);
            }
        }

        $this->dispatchNotFound();
    }

    private function match(string $requestMethod, $requestPath): ?Route {
        $route = $this->routes[$requestPath];
        if ($route->method() !== ) {
            # code...
        }
    }
}