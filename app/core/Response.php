<?php

namespace App\Core;

/**
 * كلاس Response لتسهيل إرسال الردود
 */
class Response
{
    /**
     * إرسال بيانات JSON مع كود الحالة HTTP
     *
     * @param mixed $data البيانات المراد إرسالها
     * @param int $status كود الحالة HTTP (افتراضي: 200)
     */
    public static function json(mixed $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
