<?php

namespace App\Core;

/**
 * واجهة Logger لتسجيل الرسائل
 */
interface Logger
{
    /**
     * تسجيل رسالة
     *
     * @param string $message الرسالة المراد تسجيلها
     */
    public function log(string $message): void;
}
