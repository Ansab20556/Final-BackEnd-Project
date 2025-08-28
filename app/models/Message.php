<?php

namespace App\Models;

use App\Core\App;
use PDO;

/**
 * كلاس Message لإدارة الرسائل
 */
class Message
{
    /**
     * جلب جميع الرسائل
     *
     * @return array<int, array<string, mixed>>
     */
    public function all(): array
    {
        $stm = App::db()->prepare(
            "SELECT * FROM messages ORDER BY created_at DESC"
        );
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * جلب رسالة محددة بالمعرف
     *
     * @param int $id معرف الرسالة
     * @return array<string, mixed>|false
     */
    public function find(int $id): array|false
    {
        $stm = App::db()->prepare(
            "SELECT * FROM messages WHERE message_id = :id"
        );
        $stm->execute(['id' => $id]);

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * إنشاء رسالة جديدة
     */

    public function create(
        string $name,
        string $email,
        string $content,
        string $created_at
    ): void {
        $stm = App::db()->prepare(
            "INSERT INTO messages (name, email, content, created_at, is_new)
            VALUES (:name, :email, :content, :created_at, 1)"
        );

        $stm->execute([
            'name'       => $name,
            'email'      => $email,
            'content'    => $content,
            'created_at' => $created_at
        ]);
    }

    /**
     * تحديث رسالة موجودة
     */
    public function update(
        int $id,
        string $name,
        string $email,
        string $content
    ): void {
        $stm = App::db()->prepare(
            "UPDATE messages SET
            name = :name,
            email = :email,
            content = :content
            WHERE message_id = :id"
        );

        $stm->execute([
            'name'    => $name,
            'email'   => $email,
            'content' => $content,
            'id'      => $id
        ]);
    }

    /**
     * حذف رسالة
     *
     * @param int $id معرف الرسالة
     */
    public function delete(int $id): void
    {
        $stm = App::db()->prepare(
            "DELETE FROM messages WHERE message_id = :id"
        );
        $stm->execute(['id' => $id]);
    }

    /**
     * وضع كل الرسائل الجديدة كـ مقروءة
     */
    public function markAllRead(): void {
        $stm = App::db()->prepare("UPDATE messages SET is_new = 0 WHERE is_new = 1");
        $stm->execute();
    }

}
