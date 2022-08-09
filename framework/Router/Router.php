<?php

namespace PhpFramework\Router;

class Router
{
    protected array $paths;
    protected ?Route $current;

    public function __construct()
    {
        $this->paths = [];
        $this->current = null;
    }

    public function get(string $path, $action)
    {
        $this->paths[$path] = Route::get($path, $action);
    }

    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $requestPath = $_SERVER['REQUEST_URI'] ?? '/';

        $matching = $this->match($requestMethod, $requestPath);
        if ($matching) {
            try {
                $matching->run();
            } catch (\Throwable $th) {
                $this->dispatchError($th);
            }
        } else {
            $this->dispatchNotFound();
        }
    }

    private function match(string $requestMethod, $requestPath): ?Route
    {
        if (! \array_key_exists($requestPath, $this->paths)) {
            return null;
        }

        $route = $this->paths[$requestPath];

        if ($route->method() !== $requestMethod) {
            throw new \Exception('Method not allowed');
        }

        return $route;
    }

    private function dispatchError(\Throwable $th)
    {
        http_response_code(500);
        print 'Server Error: '. $th->getMessage();
    }

    private function dispatchNotFound()
    {
        http_response_code(404);
        print '404 Error: Not found';
    }
}
