<?php
namespace App\Core;

class Auth
{
    // مهلة الجلسة بالثواني (30 دقيقة)
    public static $timeout = 1800;

    // بدء الجلسة إذا لم تبدأ
    public static function start(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    // تسجيل الدخول: تخزين بيانات المستخدم في الجلسة + regenerate id
    public static function login(array $user): void
    {
        self::start();
        // منع session fixation
        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id'       => (int) ($user['id'] ?? 0),
            'username' => $user['username'] ?? '',
            'role'     => $user['role'] ?? 'user',
        ];

        $_SESSION['last_activity'] = time();
    }

    // تحقق من وجود جلسة فعّالة وصلاحية المهلة
    public static function check(): bool
    {
        self::start();
        if (empty($_SESSION['user'])) {
            return false;
        }

        $last = $_SESSION['last_activity'] ?? 0;
        if (time() - $last > self::$timeout) {
            // انتهت المهلة -> خروج
            self::logout();
            return false;
        }

        // حدّث آخر نشاط
        $_SESSION['last_activity'] = time();
        return true;
    }

    // إرجاع بيانات المستخدم من الجلسة
    public static function user(): ?array
    {
        self::start();
        return $_SESSION['user'] ?? null;
    }

    // تنفيذ تسجيل الخروج (حذف الجلسة والكوكي)
    public static function logout(): void
    {
        self::start();
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();
    }
}
