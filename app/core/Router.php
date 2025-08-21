<?php
namespace App\Core;

final class Router
{
    private array $routes = ['GET' => [], 'POST' => []];

    public function get(string $path, $handler)
    {
        $this->routes['GET'][$this->norm($path)] = $handler;
    }

    public function post(string $path, $handler)
    {
        $this->routes['POST'][$this->norm($path)] = $handler;
    }

    public function dispatch(string $method, string $uri)
    {
        $path = $this->norm(parse_url($uri, PHP_URL_PATH) ?: '/');

        foreach ($this->routes[$method] as $route => $handler) {

            $pattern = preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $route);
            $pattern = "#^$pattern$#";

            if (preg_match($pattern, $path, $matches)) {

                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                if (is_array($handler)) {
                    [$class, $action] = $handler;
                    (new $class())->$action(...array_values($params));
                } else {
                    $handler(...array_values($params));
                }
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    private function norm(string $p): string
    {
        $p = rtrim($p, '/');
        return $p === '' ? '/' : $p;
    }
}
