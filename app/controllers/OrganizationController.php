<?php

namespace App\Controllers;

use App\Models\Organization;

class OrganizationController
{
    // ---------------- صفحات HTML عادية ----------------

    /**
     * عرض صفحة المنظمات
     */
    public function index(): void
    {
        $organizationObj = new Organization();
        $organizations   = $organizationObj->all();

        require __DIR__ . '/../views/organization/index.php';
    }

    /**
     * عرض صفحة إنشاء منظمة جديدة
     */
    public function create(): void
    {
        require __DIR__ . '/../views/organization/create.php';
    }

    /**
     * حفظ منظمة جديدة
     */
    public function store(): void
    {
        $organizationObj = new Organization();

        $name    = trim($_POST['name'] ?? '');
        $logo    = trim($_POST['logo'] ?? '');
        $vision  = trim($_POST['vision'] ?? '');
        $mission = trim($_POST['mission'] ?? '');
        $goals   = $_POST['goals'] ?? [];

        if ($name === '') {
            $error = 'الرجاء تعبئة اسم المنظمة.';
            require __DIR__ . '/../views/organization/create.php';
            return;
        }

        $organizationObj->create($name, $logo, $vision, $mission, $goals);

        header("Location: /oraganization-mvc/public/organization");
        exit;
    }

    /**
     * عرض صفحة تعديل منظمة محددة
     */
    public function edit(int $id): void
    {
        $organizationObj = new Organization();
        $organization    = $organizationObj->find($id);

        if (!$organization) {
            http_response_code(404);
            echo "Organization not found";
            return;
        }

        require __DIR__ . '/../views/organization/edit.php';
    }

    /**
     * تحديث منظمة محددة
     */
    public function update(int $id): void
    {
        $organizationObj = new Organization();

        $name    = trim($_POST['name'] ?? '');
        $logo    = trim($_POST['logo'] ?? '');
        $vision  = trim($_POST['vision'] ?? '');
        $mission = trim($_POST['mission'] ?? '');
        $goals   = $_POST['goals'] ?? [];

        $organizationObj->update($id, $name, $logo, $vision, $mission, $goals);

        header("Location: /oraganization-mvc/public/organization");
        exit;
    }

    /**
     * حذف منظمة محددة
     */
    public function delete(int $id): void
    {
        $organizationObj = new Organization();
        $organizationObj->delete($id);

        header("Location: /oraganization-mvc/public/organization");
        exit;
    }

    // ---------------- REST API JSON ----------------

    /**
     * إرجاع جميع المنظمات بصيغة JSON
     */
    public function apiIndex(): void
    {
        header('Content-Type: application/json');

        $organizationObj = new Organization();
        echo json_encode($organizationObj->all());
    }

    /**
     * حفظ منظمة جديدة عبر API
     */
    public function apiStore(): void
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        $organizationObj = new Organization();
        $organizationObj->create(
            $data['name'] ?? '',
            $data['logo'] ?? '',
            $data['vision'] ?? '',
            $data['mission'] ?? '',
            $data['goals'] ?? []
        );

        echo json_encode(['success' => true]);
    }

    /**
     * حذف منظمة محددة عبر API
     */
    public function apiDelete(int $id): void
    {
        header('Content-Type: application/json');

        $organizationObj = new Organization();
        $organizationObj->delete($id);

        echo json_encode(['success' => true]);
    }
}
