<?php

namespace App\Controllers;

use App\Models\Program;

class ProgramController
{
    // ---------------- صفحات HTML عادية ----------------

    /**
     * عرض صفحة البرامج
     */
    public function index(): void
    {
        $programObj = new Program();
        $programs   = $programObj->all();

        require __DIR__ . '/../views/programs/index.php';
    }

    /**
     * عرض صفحة إنشاء برنامج جديد
     */
    public function create(): void
    {
        require __DIR__ . '/../views/programs/create.php';
    }

    /**
     * حفظ برنامج جديد
     */
    public function store(): void
    {
        $programObj = new Program();

        $title     = trim($_POST['title'] ?? '');
        $description = trim($_POST['desc'] ?? '');
        $startDate = trim($_POST['start_date'] ?? '');
        $endDate   = trim($_POST['end_date'] ?? '');
        $type      = trim($_POST['type'] ?? '');
        $region    = trim($_POST['region'] ?? '');

        if ($title === '' || $description === '' || $startDate === '' || $endDate === '' || $type === '' || $region === '') {
            $error = 'الرجاء تعبئة كل الحقول.';
            require __DIR__ . '/../views/programs/create.php';
            return;
        }

        $programObj->create($title, $description, $startDate, $endDate, $type, $region);

        header("Location: /oraganization-mvc/public/programs");
        exit;
    }

    /**
     * عرض صفحة تعديل برنامج محدد
     */
    public function edit(int $id): void
    {
        $programObj = new Program();
        $program    = $programObj->find($id);

        if (!$program) {
            http_response_code(404);
            echo "Program not found";
            return;
        }

        require __DIR__ . '/../views/programs/edit.php';
    }

    /**
     * تحديث برنامج محدد
     */
    public function update(int $id): void
    {
        $programObj = new Program();
        $data       = $_POST;

        if (empty($data) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
            $data = json_decode(file_get_contents("php://input"), true);
        }

        $programObj->update(
            $id,
            $data['title'] ?? '',
            $data['desc'] ?? '',
            $data['start_date'] ?? '',
            $data['end_date'] ?? '',
            $data['type'] ?? '',
            $data['region'] ?? ''
        );

        header("Location: /oraganization-mvc/public/programs");
        exit;
    }

    /**
     * حذف برنامج محدد
     */
    public function delete(int $id): void
    {
        $programObj = new Program();
        $programObj->delete($id);

        header("Location: /oraganization-mvc/public/programs");
        exit;
    }

    // ---------------- REST API JSON ----------------

    /**
     * إرجاع جميع البرامج بصيغة JSON
     */
    public function apiIndex(): void
    {
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        $programObj = new Program();
        echo json_encode([
            "status" => "success",
            "data"   => $programObj->all()
        ]);
    }

    /**
     * عرض برنامج محدد بصيغة JSON
     */
    public function apiShow(int $id): void
    {
        header("Content-Type: application/json; charset=UTF-8");

        $programObj = new Program();
        $program    = $programObj->find($id);

        if ($program) {
            echo json_encode([
                "status" => "success",
                "data"   => $program
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                "status"  => "error",
                "message" => "Program not found"
            ]);
        }
    }

    /**
     * حفظ برنامج جديد عبر API
     */
    public function apiStore(): void
    {
        header("Content-Type: application/json; charset=UTF-8");

        $programObj = new Program();
        $data       = json_decode(file_get_contents("php://input"), true);

        $programObj->create(
            $data['title'] ?? '',
            $data['desc'] ?? '',
            $data['start_date'] ?? '',
            $data['end_date'] ?? '',
            $data['type'] ?? '',
            $data['region'] ?? ''
        );

        echo json_encode(["status" => "success"]);
    }

    /**
     * تحديث برنامج محدد عبر API
     */
    public function apiUpdate(int $id): void
    {
        header("Content-Type: application/json; charset=UTF-8");

        $programObj = new Program();
        $data       = json_decode(file_get_contents("php://input"), true);

        $programObj->update(
            $id,
            $data['title'] ?? '',
            $data['desc'] ?? '',
            $data['start_date'] ?? '',
            $data['end_date'] ?? '',
            $data['type'] ?? '',
            $data['region'] ?? ''
        );

        echo json_encode(["status" => "success"]);
    }

    /**
     * حذف برنامج محدد عبر API
     */
    public function apiDelete(int $id): void
    {
        header('Content-Type: application/json');

        $programObj = new Program();
        $programObj->delete($id);

        echo json_encode(['success' => true]);
    }

    /**
     * حذف جميع البرامج عبر API
     */
    public function apiDeleteAll(): void
    {
        header("Content-Type: application/json; charset=UTF-8");

        $programObj = new Program();
        $all        = $programObj->all();

        foreach ($all as $p) {
            $programObj->delete((int) $p['program_id']);
        }

        echo json_encode(["status" => "success"]);
    }
}
