<?php

namespace App\Controllers;

use App\Models\Donation;

class DonationController
{
    /**
     * عرض صفحة التبرعات (HTML)
     */
    public function index(): void
    {
        $donation  = new Donation();
        $donations = $donation->all();

        require __DIR__ . '/../views/donations/index.php';
    }

    /**
     * عرض صفحة إنشاء تبرع جديد
     */
    public function create(): void
    {
        require __DIR__ . '/../views/donations/create.php';
    }

    /**
     * حفظ تبرع جديد
     */
    public function store(): void
    {
        $donation        = new Donation();
        $donorName       = trim($_POST['donor_name'] ?? '');
        $donationType    = trim($_POST['donation_type'] ?? '');
        $amount          = $_POST['amount'] ?? 0;
        $itemDescription = trim($_POST['item_description'] ?? '');
        $donationDate    = $_POST['donation_date'] ?? '';
        $confirmed       = isset($_POST['confirmed']) ? 1 : 0;

        if ($donorName === '' || $donationType === '' || $donationDate === '') {
            $error = "الرجاء تعبئة الحقول المطلوبة";
            require __DIR__ . '/../views/donations/create.php';
            return;
        }

        $donation->create(
            $donorName,
            $donationType,
            $amount,
            $itemDescription,
            $donationDate,
            $confirmed
        );

        header("Location: /oraganization-mvc/public/donations");
        exit;
    }

    /**
     * عرض صفحة تعديل تبرع
     */
    public function edit(int $id): void
    {
        $donation = new Donation();
        $don      = $donation->find($id);

        if (!$don) {
            http_response_code(404);
            echo "Donation not found";
            return;
        }

        require __DIR__ . '/../views/donations/edit.php';
    }

    /**
     * تحديث بيانات التبرع
     */
    public function update(int $id): void
    {
        $donation        = new Donation();
        $donorName       = trim($_POST['donor_name'] ?? '');
        $donationType    = trim($_POST['donation_type'] ?? '');
        $amount          = $_POST['amount'] ?? 0;
        $itemDescription = trim($_POST['item_description'] ?? '');
        $donationDate    = $_POST['donation_date'] ?? '';
        $confirmed       = isset($_POST['confirmed']) ? 1 : 0;

        $donation->update(
            $id,
            $donorName,
            $donationType,
            $amount,
            $itemDescription,
            $donationDate,
            $confirmed
        );

        header("Location: /oraganization-mvc/public/donations");
        exit;
    }

    /**
     * حذف تبرع محدد
     */
    public function delete(int $id): void
    {
        $donation = new Donation();
        $donation->delete($id);

        header("Location: /oraganization-mvc/public/donations");
        exit;
    }

    // ---------------- REST API JSON ----------------

    /**
     * إرجاع جميع التبرعات بصيغة JSON
     */
    public function apiIndex(): void
    {
        header('Content-Type: application/json');

        $donation = new Donation();
        echo json_encode($donation->all());
    }

    /**
     * حفظ تبرع جديد عبر API
     */
    public function apiStore(): void
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON']);
            return;
        }

        $donation = new Donation();
        $donation->create(
            $data['donor_name'] ?? '',
            $data['donation_type'] ?? '',
            $data['amount'] ?? 0,
            $data['item_description'] ?? '',
            $data['donation_date'] ?? '',
            $data['confirmed'] ?? 0
        );

        echo json_encode(['success' => true]);
    }

    /**
     * تحديث تبرع محدد عبر API
     */
    public function apiUpdate(int $id): void
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON']);
            return;
        }

        $donation = new Donation();
        $donation->update(
            $id,
            $data['donor_name'] ?? '',
            $data['donation_type'] ?? '',
            $data['amount'] ?? 0,
            $data['item_description'] ?? '',
            $data['donation_date'] ?? '',
            $data['confirmed'] ?? 0
        );

        echo json_encode(['success' => true]);
    }

    /**
     * حذف تبرع محدد عبر API
     */
    public function apiDelete(int $id): void
    {
        header('Content-Type: application/json');

        $donation = new Donation();
        $donation->delete($id);

        echo json_encode(['success' => true]);
    }

    /**
     * حذف جميع التبرعات عبر API
     */
    public function apiDeleteAll(): void
    {
        header("Content-Type: application/json; charset=UTF-8");

        $donation = new Donation();
        $all      = $donation->all();

        foreach ($all as $d) {
            $donation->delete((int) $d['donation_id']);
        }

        echo json_encode(["status" => "success"]);
    }
}
