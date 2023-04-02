<?php

namespace Core;

class Router
{
    protected array $routes = [];

    public function route(
        string $method,
        string $uri,
    )
    {
        foreach ($this->routes as $route) {
            if (
                $route['uri'] === $uri
                && strtoupper($method) === $route['method']
            ) {
                return (new $route['handler'])->{$route['func']}();
            }
        }
        return abort(404);
    }

    public function add(
        string $method,
        string $uri,
        string|callable $handler,
        ?string $func = null,
    ): void
    {
        $this->routes[] = [
            'uri' => $uri,
            'handler' => $handler,
            'func' => $func,
            'method' => $method
        ];
    }

    public function get(
        string $uri,
        string|callable $handler,
        ?string $method = null
    ): void
    {
        $this->add(
            'GET',
            $uri,
            $handler,
            $method
        );
    }

    public function post(
        string $uri,
        string|callable $handler,
        ?string $method = null
    ): void
    {
        $this->add(
            'POST',
            $uri,
            $handler,
            $method
        );
    }

    public function patch(
        string $uri,
        string|callable $handler,
        ?string $method = null
    ): void
    {
        $this->add(
            'PATCH',
            $uri,
            $handler,
            $method
        );
    }

    public function put(
        string $uri,
        string|callable $handler,
        ?string $method = null
    ): void
    {
        $this->add(
            'PUT',
            $uri,
            $handler,
            $method
        );
    }

    public function delete(
        string $uri,
        string|callable $handler,
        ?string $method = null
    ): void
    {
        $this->add(
            'DELETE',
            $uri,
            $handler,
            $method
        );
    }
}
