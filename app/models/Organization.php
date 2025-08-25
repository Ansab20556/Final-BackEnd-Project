<?php

namespace App\Models;

use App\Core\App;
use PDO;

/**
 * كلاس Organization لإدارة بيانات المنظمة
 */
class Organization
{
    /**
     * جلب جميع المنظمات
     *
     * @return array<int, array<string, mixed>>
     */
    public function all(): array
    {
        $stm = App::db()->prepare("SELECT * FROM organization");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * جلب منظمة محددة بالمعرف
     *
     * @param int $id معرف المنظمة
     * @return array<string, mixed>|false
     */
    public function find(int $id): array|false
    {
        $stm = App::db()->prepare("SELECT * FROM organization WHERE id = :id");
        $stm->execute(['id' => $id]);

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * إنشاء منظمة جديدة
     */
    public function create(
        string $name,
        string $logo,
        string $vision,
        string $mission,
        array $goals
    ): void {
        $stm = App::db()->prepare(
            "INSERT INTO organization (name, logo, vision, mission, goals)
            VALUES (:name, :logo, :vision, :mission, :goals)"
        );

        $stm->execute([
            'name'   => $name,
            'logo'   => $logo,
            'vision' => $vision,
            'mission'=> $mission,
            'goals'  => json_encode($goals, JSON_UNESCAPED_UNICODE)
        ]);
    }

    /**
     * تحديث بيانات منظمة موجودة
     */
    public function update(
        int $id,
        string $name,
        string $logo,
        string $vision,
        string $mission,
        array $goals
    ): bool {
        $stm = App::db()->prepare(
            "UPDATE organization
             SET name = :name,
                 logo = :logo,
                 vision = :vision,
                 mission = :mission,
                 goals = :goals
             WHERE id = :id"
        );

        return $stm->execute([
            'id'     => $id,
            'name'   => $name,
            'logo'   => $logo,
            'vision' => $vision,
            'mission'=> $mission,
            'goals'  => json_encode($goals, JSON_UNESCAPED_UNICODE)
        ]);
    }

    /**
     * حذف منظمة
     *
     * @param int $id معرف المنظمة
     */
    public function delete(int $id): void
    {
        $stm = App::db()->prepare("DELETE FROM organization WHERE id = :id");
        $stm->execute(['id' => $id]);
    }
}
