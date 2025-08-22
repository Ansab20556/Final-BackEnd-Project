<?php
namespace App\Core;

class LoggerFactory {
    public static function create(string $type): Logger {
        return match($type) {
            "file" => new FileLogger(),
            // لاحقاً يمكن إضافة DatabaseLogger أو أي Logger آخر
        };
    }
}
