<?php

namespace Core;

class Application
{
    /**
     * @var Container
     */
    protected static Container $container;
    /**
     * @var array
     */

    protected array $server;
    /**
     * @var array
     */

    protected array $request;

    /**
     * @param Container $container
     * @return void
     */
    public static function setContainer(Container $container): void
    {
        static::$container = $container;
    }

    /**
     * @return Container
     */
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

    /**
     * @return $this
     */
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

    /**
     * @param array $server
     * @return $this
     */
    public function start(array $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * @param array $request
     * @return $this
     */
    public function capture(array $request): self
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return void
     */
    public function serve(): void
    {
        $this->bootRoutes();
    }
}
