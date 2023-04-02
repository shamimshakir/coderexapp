<?php

namespace Core;

class Application
{
    protected static Container $container;
    protected array $server;
    protected array $request;

    public static function setContainer(Container $container): void
    {
        static::$container = $container;
    }

    public static function container(): Container
    {
        return static::$container;
    }

    /**
     * @throws \Exception
     */
    public static function resolve(string $class): mixed
    {
        return static::container()->resolve($class);
    }

    /**
     * @throws \Exception
     */
    public static function bind(string|array $key, mixed $resolver = null): void
    {
        static::container()->bind($key, $resolver);
    }

    public function bootRoutes(): static
    {
        $router = require BASE_PATH . "/routes/index.php";
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $method = $_SERVER['_method'] ?? $_SERVER['REQUEST_METHOD'];
        $router->route(
            $method,
            $uri
        );
        return $this;
    }

    public function start(array $server): self
    {
        $this->server = $server;
        return $this;
    }

    public function capture(array $request): self
    {
        $this->request = $request;
        return $this;
    }

    public function serve(): void
    {
        $this->bootRoutes();
    }
}
