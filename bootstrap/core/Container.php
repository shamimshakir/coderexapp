<?php

namespace Core;

use ReflectionClass;

class Container
{
    protected array $bindings = [];
    protected array $resolvedDependencies = [];
    public function bind(string|array $key, mixed $resolver = null): void
    {
        if (!is_array($key)) {
            $this->bindings[$key] = $resolver;
            return;
        }

        $this->bindings = array_merge($this->bindings, $key);

    }

    public function make(string $key): mixed
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception(" Bonk! No bindings has been added for $key");
        }

        $resolver = $this->bindings[$key];
        return call_user_func($resolver);
    }

    public function resolve(string $className): mixed
    {
        // Check if the class has already been resolved and return it if so
        if (isset($this->resolvedDependencies[$className])) {
            return $this->resolvedDependencies[$className];
        }

        // Get the constructor for the class
        $class = new ReflectionClass($className);
        $constructor = $class->getConstructor();

        // If there is no constructor, create an instance of the class and return it
        if (!$constructor) {
            $instance = new $className;
            $this->resolvedDependencies[$className] = $instance;
            return $instance;
        }

        // Get the parameters for the constructor
        $parameters = $constructor->getParameters();

        // Resolve each parameter recursively
        $resolvedParameters = [];
        foreach ($parameters as $parameter) {
            $type = $parameter->getType();

            // If the parameter doesn't have a type or it's a primitive type, try to get its default value
            if (!$type || $type->isBuiltin()) {
                if ($parameter->isDefaultValueAvailable()) {
                    $resolvedParameters[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Cannot resolve parameter {$parameter->getName()} for class {$className}");
                }
            } else {
                // Recursively resolve the dependent class
                $dependentClassName = $type->getName();
                $resolvedParameters[] = $this->resolve($dependentClassName);
            }
        }

        // Create an instance of the class with the resolved parameters and return it
        $instance = $class->newInstanceArgs($resolvedParameters);
        $this->resolvedDependencies[$className] = $instance;
        return $instance;
    }

    public function get(string $class): mixed
    {
        return $this->resolvedDependencies[$class];
    }
}