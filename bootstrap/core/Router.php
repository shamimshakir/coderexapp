<?php

namespace Core;

class Router
{
    protected Application $app;

    protected array $routes = [];

    /**
     * @throws \ReflectionException
     */
    public function route(
        string $method,
        string $uri,
    )
    {
//        $method = 'GET';
//        $uri = '/hello/1/go';
        foreach ($this->routes as $route) {
            if (
                $this->match($route, $uri)
                && strtoupper($method) === $route['method']
            ) {
                $this->app::resolve($route['handler']);
                return $this->resolveHandlerWithDependencies($route);
            }
        }
        return abort(404);
    }

    /**
     * @param $route
     * @param $uri
     * @return bool
     */
    private function match(&$route, $uri): bool
    {
        if (preg_match($route['matcher'], $uri, $matches)) {
            foreach ($matches as $key => $value) {
                if (is_string($key) && !is_numeric($key)) {
                    $route['params'][$key] = $value;
                }
            }
            return true;
        }
        return false;
    }

    public function add(
        string $method,
        string $uri,
        string|callable $handler,
        ?string $func = null,
    ): void
    {
        $route = preg_replace('/\//', '\\/', $uri);
        $matcher = preg_replace('/\{([a-z_]+)\}/', '(?P<\1>[^\/]+)', $route);

        $this->routes[] = [
            'uri' => $uri,
            'handler' => $handler,
            'func' => $func,
            'method' => $method,
            'params' => [],
            'matcher' => '/^' . $matcher . '$/i'
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

    /**
     * @return Application
     */
    public function getApp(): Application
    {
        return $this->app;
    }

    /**
     * @param Application $app
     * @return Router
     */
    public function setApp(Application $app): static
    {
        $this->app = $app;
        return $this;
    }

    /**
     * @throws \ReflectionException
     */
    private function resolveHandlerWithDependencies(mixed $route)
    {
        $instance = $this->app::get($route['handler']);
        return $instance->{$route['func']}(
            $this->app->getRequest(),
            ...$route['params']
        );
    }

}
