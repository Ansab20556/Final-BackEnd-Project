<?php

namespace App\Models;

use App\Core\App;
use PDO;

/**
 * كلاس User لإدارة بيانات المستخدمين
 */
class User
{
    /**
     * جلب المستخدم بواسطة البريد الإلكتروني
     *
     * @param string $email
     * @return array<string, mixed>|false
     */
    public function findByEmail(string $email): array|false
    {
        $stmt = App::db()->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * جلب كل المستخدمين
     *
     * @return array<int, array<string, mixed>>
     */
    public function all(): array
    {
        $stm = App::db()->prepare("SELECT * FROM users");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * جلب مستخدم بواسطة المعرف
     *
     * @param int $id
     * @return array<string, mixed>|false
     */
    public function find(int $id): array|false
    {
        $stm = App::db()->prepare("SELECT * FROM users WHERE id = :id");
        $stm->execute(['id' => $id]);

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * إنشاء مستخدم جديد
     */
    public function create(string $username, string $email, string $password, string $role): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stm = App::db()->prepare(
            "INSERT INTO users(username, email, password, role)
             VALUES(:username, :email, :password, :role)"
        );

        $stm->execute([
            'username' => $username,
            'email'    => $email,
            'password' => $hashedPassword,
            'role'     => $role
        ]);
    }

    /**
     * تحديث بيانات مستخدم
     */
    public function update(int $id, string $username, string $email, ?string $password, string $role): void
    {
        if ($password !== null && $password !== '') {
            $stm = App::db()->prepare(
                "UPDATE users SET username = :username, email = :email, password = :password, role = :role WHERE id = :id"
            );

            $stm->execute([
                'username' => $username,
                'email'    => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role'     => $role,
                'id'       => $id
            ]);
        } else {
            $stm = App::db()->prepare(
                "UPDATE users SET username = :username, email = :email, role = :role WHERE id = :id"
            );

            $stm->execute([
                'username' => $username,
                'email'    => $email,
                'role'     => $role,
                'id'       => $id
            ]);
        }
    }

    /**
     * حذف مستخدم بواسطة المعرف
     */
    public function delete(int $id): void
    {
        $stm = App::db()->prepare("DELETE FROM users WHERE id = :id");
        $stm->execute(['id' => $id]);
    }

    /**
     * حذف كل المستخدمين
     */
    public function deleteAll(): void
    {
        $stm = App::db()->prepare("DELETE FROM users");
        $stm->execute();
    }
}
