<?php

namespace App\Models;

use App\Core\App;
use PDO;

/**
 * كلاس Program لإدارة برامج المنظمة
 */
class Program
{
    /**
     * جلب جميع البرامج
     *
     * @return array<int, array<string, mixed>>
     */
    public function all(): array
    {
        $stm = App::db()->prepare("SELECT * FROM programs");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * جلب برنامج معين بالمعرف
     *
     * @param int $id معرف البرنامج
     * @return array<string, mixed>|false
     */
    public function find(int $id): array|false
    {
        $stm = App::db()->prepare("SELECT * FROM programs WHERE program_id = :id");
        $stm->execute(['id' => $id]);

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * إنشاء برنامج جديد
     */
    public function create(
        string $title,
        string $descrip,
        string $startDate,
        string $endDate,
        string $type,
        string $region
    ): void {
        $stm = App::db()->prepare(
            "INSERT INTO programs (title, descrip, startt_date, end_date, typ, region)
             VALUES (:title, :descrip, :startt_date, :end_date, :typ, :region)"
        );

        $stm->execute([
            'title'       => $title,
            'descrip'     => $descrip,
            'startt_date' => $startDate,
            'end_date'    => $endDate,
            'typ'         => $type,
            'region'      => $region
        ]);
    }

    /**
     * تحديث برنامج موجود
     */
    public function update(
        int $id,
        string $title,
        string $descrip,
        string $startDate,
        string $endDate,
        string $type,
        string $region
    ): bool {
        $stm = App::db()->prepare(
            "UPDATE programs
             SET title = :title,
                 descrip = :descrip,
                 startt_date = :startt_date,
                 end_date = :end_date,
                 typ = :typ,
                 region = :region
             WHERE program_id = :id"
        );

        return $stm->execute([
            'id'          => $id,
            'title'       => $title,
            'descrip'     => $descrip,
            'startt_date' => $startDate,
            'end_date'    => $endDate,
            'typ'         => $type,
            'region'      => $region
        ]);
    }

    /**
     * حذف برنامج
     *
     * @param int $id معرف البرنامج
     */
    public function delete(int $id): void
    {
        $stm = App::db()->prepare("DELETE FROM programs WHERE program_id = :id");
        $stm->execute(['id' => $id]);
    }
}
