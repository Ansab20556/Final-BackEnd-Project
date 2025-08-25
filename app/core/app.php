<?php

namespace App\Core;

use PDO;
use PDOException;

final class App
{
    /**
     * كائن PDO ثابت لإعادة الاستخدام
     */
    private static ?PDO $pdo = null;

    /**
     * تهيئة الاتصال بقاعدة البيانات
     */
    public static function init(): void
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=localhost;dbname=wfp_portal;charset=utf8',
                    'root',
                    '',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
    }

    /**
     * إرجاع كائن PDO
     */
    public static function db(): PDO
    {
        if (self::$pdo === null) {
            self::init();
        }

        return self::$pdo;
    }
}
