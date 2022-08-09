<?php

namespace PhpFramework\Router;

class Route
{
    protected string $path;
    protected string $method;
    protected $action;

    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';


    private function __construct(string $path, string $method, $action)
    {
        $this->path = $path;
        $this->method = $method;
        $this->action = $action;
    }

    public static function get(string $path, $action): self
    {
        return new Route($path, static::GET, $action);
    }

    public function run()
    {
        if (\is_array($this->action)) {
            [$controllerName, $methodName] = $this->action;
            (new $controllerName())->$methodName();
        } else {
            ($this->action)();
        }
    }

    public function path(): string
    {
        return $this->path;
    }

    public function action()
    {
        return $this->action;
    }

    public function method()
    {
        return $this->method;
    }
}
