<?php

namespace Core;

class Container
{
    protected array $bindings = [];
    public function bind(string|array $key, mixed $resolver = null): void
    {
        if (!is_array($key)) {
            $this->bindings[$key] = $resolver;
            return;
        }

        $this->bindings = array_merge($this->bindings, $key);

    }

    public function resolve(string $key): mixed
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception(" Bonk! No bindings has been added for $key");
        }

        $resolver = $this->bindings[$key];
        return call_user_func($resolver);
    }
}