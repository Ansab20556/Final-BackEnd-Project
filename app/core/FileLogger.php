<?php
namespace App\Core;

class FileLogger implements Logger {
    public function log(string $message): void {
        $dir = __DIR__ . '/../../logs';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($dir . "/app.log", $message . PHP_EOL, FILE_APPEND);
    }
}
