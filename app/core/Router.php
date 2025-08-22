<?php
namespace App\Core;

final class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => []
    ];

    public function get(string $path, $handler)
    {
        $this->routes['GET'][$this->norm($path)] = $handler;
    }

    public function post(string $path, $handler)
    {
        $this->routes['POST'][$this->norm($path)] = $handler;
    }

    public function put(string $path, $handler)
    {
        $this->routes['PUT'][$this->norm($path)] = $handler;
    }

    public function delete(string $path, $handler)
    {
        $this->routes['DELETE'][$this->norm($path)] = $handler;
    }

    public function dispatch(string $method, string $uri)
    {
        $path = $this->norm(parse_url($uri, PHP_URL_PATH) ?: '/');

        // ✅ دعم Method Override في الفورم (POST مع hidden _method)
        if ($method === 'POST' && isset($_POST['_method'])) {
            $override = strtoupper($_POST['_method']);
            if (in_array($override, ['PUT', 'DELETE'])) {
                $method = $override;
            }
        }

        foreach ($this->routes[$method] as $route => $handler) {
            $pattern = preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $route);
            $pattern = "#^$pattern$#";

            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                if (is_array($handler)) {
                    [$class, $action] = $handler;
                    (new $class())->$action(...array_values($params));
                } 
                else 
                    {
                        $handler(...array_values($params));
                    }
                return;
            }
        }

        http_response_code(404);
        require __DIR__ . '/../views/errors/404.php';
        exit;
    }

    private function norm(string $p): string
    {
        $p = rtrim($p, '/');
        return $p === '' ? '/' : $p;
    }
}
