<?php

namespace App\Models;

use App\Core\App;
use PDO;

/**
 * كلاس Donation لإدارة التبرعات
 */
class Donation
{
    /**
     * جلب جميع التبرعات
     *
     * @return array<int, array<string, mixed>>
     */
    public function all(): array
    {
        $stm = App::db()->prepare(
            "SELECT * FROM donations ORDER BY created_at DESC"
        );
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * جلب تبرع محدد بالمعرف
     *
     * @param int $id معرف التبرع
     * @return array<string, mixed>|false
     */
    public function find(int $id): array|false
    {
        $stm = App::db()->prepare(
            "SELECT * FROM donations WHERE donation_id = :id"
        );
        $stm->execute(['id' => $id]);

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * إنشاء تبرع جديد
     */
    public function create(
        string $donor_name,
        string $donation_type,
        float|int $amount,
        string $item_description,
        string $donation_date,
        int $confirmed
    ): void {
        $stm = App::db()->prepare(
            "INSERT INTO donations
            (donor_name, donation_type, amount, item_description, donation_date, confirmed)
            VALUES(:donor_name, :donation_type, :amount, :item_description, :donation_date, :confirmed)"
        );

        $stm->execute([
            'donor_name' => $donor_name,
            'donation_type' => $donation_type,
            'amount' => $amount,
            'item_description' => $item_description,
            'donation_date' => $donation_date,
            'confirmed' => $confirmed
        ]);
    }

    /**
     * تحديث تبرع موجود
     */
    public function update(
        int $id,
        string $donor_name,
        string $donation_type,
        float|int $amount,
        string $item_description,
        string $donation_date,
        int $confirmed
    ): void {
        $stm = App::db()->prepare(
            "UPDATE donations SET
            donor_name = :donor_name,
            donation_type = :donation_type,
            amount = :amount,
            item_description = :item_description,
            donation_date = :donation_date,
            confirmed = :confirmed
            WHERE donation_id = :id"
        );

        $stm->execute([
            'donor_name' => $donor_name,
            'donation_type' => $donation_type,
            'amount' => $amount,
            'item_description' => $item_description,
            'donation_date' => $donation_date,
            'confirmed' => $confirmed,
            'id' => $id
        ]);
    }

    /**
     * حذف تبرع
     *
     * @param int $id معرف التبرع
     */
    public function delete(int $id): void
    {
        $stm = App::db()->prepare(
            "DELETE FROM donations WHERE donation_id = :id"
        );
        $stm->execute(['id' => $id]);
    }
}
