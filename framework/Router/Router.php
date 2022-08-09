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

    /**
     * Register a GET route
     *
     * @param string $path
     * @param callable|array $action
     * @return void
     */
    public function get(string $path, $action)
    {
        $this->paths[$path] = Route::get($path, $action);
    }

    /**
     * Dispatch a request url to the right handler
     *
     * @return void
     */
    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? Route::GET;
        $requestPath = $_SERVER['REQUEST_URI'] ?? '/';

        $matching = $this->match($requestMethod, $requestPath);
        if ($matching) {
            // if an error occurs, show it to the user
            try {
                $matching->run();
            } catch (\Throwable $th) {
                $this->dispatchError($th);
            }
        } else {
            // no matching route has been found
            $this->dispatchNotFound();
        }
    }

    /**
     * Match an URL from registered routes
     * Exact match implementation
     *
     * @param string $requestMethod
     * @param string $requestPath
     * @return Route|null
     */
    private function match(string $requestMethod, string $requestPath): ?Route
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

    /**
     * Dispatch a Server Error (code 500)
     * and show related error message
     * 
     * @param \Throwable $th
     * @return void
     */
    private function dispatchError(\Throwable $th)
    {
        \http_response_code(500);
        print 'Server Error: '. $th->getMessage();
    }

    /**
     * Dispatch a Not Found Error (code 404)
     *
     * @return void
     */
    private function dispatchNotFound()
    {
        \http_response_code(404);
        print '404 Error: Not found';
    }
}
