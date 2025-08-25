<?php

namespace App\Core;

/**
 * كلاس Router لإدارة التوجيه بين المسارات
 */
final class Router
{
    /**
     * مصفوفة المسارات لكل Method
     *
     * @var array<string, array<string, callable|array>>
     */
    private array $routes = [
        'GET'    => [],
        'POST'   => [],
        'PUT'    => [],
        'DELETE' => []
    ];

    /**
     * إضافة مسار GET
     */
    public function get(string $path, callable|array $handler): void
    {
        $this->routes['GET'][$this->norm($path)] = $handler;
    }

    /**
     * إضافة مسار POST
     */
    public function post(string $path, callable|array $handler): void
    {
        $this->routes['POST'][$this->norm($path)] = $handler;
    }

    /**
     * إضافة مسار PUT
     */
    public function put(string $path, callable|array $handler): void
    {
        $this->routes['PUT'][$this->norm($path)] = $handler;
    }

    /**
     * إضافة مسار DELETE
     */
    public function delete(string $path, callable|array $handler): void
    {
        $this->routes['DELETE'][$this->norm($path)] = $handler;
    }

    /**
     * تنفيذ التوجيه حسب Method و URI
     */
    public function dispatch(string $method, string $uri): void
    {
        $path = $this->norm(parse_url($uri, PHP_URL_PATH) ?: '/');

        // دعم Method Override في الفورم (POST مع hidden _method)
        if ($method === 'POST' && isset($_POST['_method'])) {
            $override = strtoupper($_POST['_method']);
            if (in_array($override, ['PUT', 'DELETE'], true)) {
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
                } else {
                    $handler(...array_values($params));
                }

                return;
            }
        }

        http_response_code(404);
        require __DIR__ . '/../views/errors/404.php';
        exit;
    }

    /**
     * توحيد شكل المسار (بدون / في النهاية)
     */
    private function norm(string $path): string
    {
        $path = rtrim($path, '/');
        return $path === '' ? '/' : $path;
    }
}
