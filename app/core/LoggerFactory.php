<?php

namespace App\Core;

/**
 * Factory لإنشاء كائنات Logger مختلفة
 */
class LoggerFactory
{
    /**
     * إنشاء Logger حسب النوع
     *
     * @param string $type نوع الـ Logger (مثال: 'file')
     * @return Logger
     */
    public static function create(string $type): Logger
    {
        return match ($type) {
            'file' => new FileLogger(),
            // لاحقاً يمكن إضافة DatabaseLogger أو أي Logger آخر
        };
    }
}
