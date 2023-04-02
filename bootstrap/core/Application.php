<?php

namespace Core;

class Application
{
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
        return $this;
    }

    public function capture(array $request): self
    {
        return $this;
    }

    public function serve()
    {
        $this->bootRoutes();
    }
}
