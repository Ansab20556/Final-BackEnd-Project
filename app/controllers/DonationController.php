<?php
namespace App\Controllers;

use App\Models\Donation;

class DonationController
{
    // صفحة HTML العادية
    function index()
    {
        $donation = new Donation();
        $donations = $donation->all();
        require __DIR__ . '/../views/donations/index.php';
    }

    function create()
    {
        require __DIR__ . '/../views/donations/create.php';
    }

    function store()
    {
        $donation = new Donation();

        $donor_name      = trim($_POST['donor_name'] ?? '');
        $donation_type   = trim($_POST['donation_type'] ?? '');
        $amount          = $_POST['amount'] ?? 0;
        $item_description = trim($_POST['item_description'] ?? '');
        $donation_date   = $_POST['donation_date'] ?? '';
        $confirmed       = isset($_POST['confirmed']) ? 1 : 0;

        if ($donor_name === '' || $donation_type === '' || $donation_date === '') {
            $error = "الرجاء تعبئة الحقول المطلوبة";
            require __DIR__ . '/../views/donations/create.php';
            return;
        }

        $donation->create($donor_name, $donation_type, $amount, $item_description, $donation_date, $confirmed);

        header("Location: /oraganization-mvc/public/donations");
        exit;
    }

    function edit($id)
    {
        $donation = new Donation();
        $don = $donation->find($id);
        if (!$don) {
            http_response_code(404);
            echo "Donation not found";
            return;
        }
        require __DIR__ . '/../views/donations/edit.php';
    }

    function update($id)
    {
        $donation = new Donation();

        $donor_name      = trim($_POST['donor_name'] ?? '');
        $donation_type   = trim($_POST['donation_type'] ?? '');
        $amount          = $_POST['amount'] ?? 0;
        $item_description = trim($_POST['item_description'] ?? '');
        $donation_date   = $_POST['donation_date'] ?? '';
        $confirmed       = isset($_POST['confirmed']) ? 1 : 0;

        $donation->update($id, $donor_name, $donation_type, $amount, $item_description, $donation_date, $confirmed);

        header("Location: /oraganization-mvc/public/donations");
        exit;
    }

    function delete($id)
    {
        $donation = new Donation();
        $donation->delete($id);
        header("Location: /oraganization-mvc/public/donations");
        exit;
    }

    // ---------------- REST API JSON ----------------
    function apiIndex()
    {
        header('Content-Type: application/json');
        $donation = new Donation();
        echo json_encode($donation->all());
    }

    function apiStore()
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

    function apiDelete($id)
    {
        header('Content-Type: application/json');
        $donation = new Donation();
        $donation->delete($id);
        echo json_encode(['success' => true]);
    }
}
