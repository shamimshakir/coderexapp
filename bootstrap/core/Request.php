<?php

namespace Core;

class Request
{
    private static mixed $request;
    private static mixed $server;
    public string $method;
    public string $scheme;
    public string $uri;
    public ?string $queryString;
    public array $query = [];
    public array $params = [];
    public mixed $body = [];
    public array $headers = [];

    protected mixed $raw;

    public static function capture(array $request, array $server): static
    {
        static::$request = $request;
        static::$server = $server;

        $instance = new static();
        $instance->method = $server['REQUEST_METHOD'];
        $instance->scheme = $server['REQUEST_SCHEME'];
        $instance->uri = $server['REQUEST_URI'];
        parse_str($server['QUERY_STRING'], $instance->query);
        $instance->raw = $_POST ?: file_get_contents('php://input');
        $instance->body = json_decode($instance->getRaw());
        $instance->queryString = $server['QUERY_STRING'] ?: null;
        $instance->headers = getallheaders();

        return $instance;
    }

    /**
     * @return mixed
     */
    public function getRaw(): mixed
    {
        return $this->raw;
    }

}