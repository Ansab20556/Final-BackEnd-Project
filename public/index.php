<?php
// index.php (أول الملف)
header("Access-Control-Allow-Origin: http://localhost:5173"); // أو * للتجربة
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') 
    {
        http_response_code(200);
        exit;
    }

// Simple PSR-4-ish autoloader for App\*
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    if (strncmp($class, $prefix, strlen($prefix)) === 0) {
        $relative = str_replace('\\', '/', substr($class, strlen($prefix)));
        $file = __DIR__ . '/../app/' . $relative . '.php';
        if (file_exists($file)) require $file;
    }
});

// Create router and include all routes
$router = new App\Core\Router();
require __DIR__ . '/../routes/web.php';

// Dispatch current request
// echo $_SERVER['REQUEST_URI'];
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


