<?php
namespace App\Controllers;

use App\Models\Organization;

class OrganizationController 
{
    function index() 
    {
        $org = new Organization();
        $organizations = $org->all();
        require __DIR__ . '/../views/organization/index.php';
    }

    function create() 
    {
        require __DIR__ . '/../views/organization/create.php';
    }

    function store() 
    {
        $org = new Organization();

        $name = trim($_POST['name'] ?? '');
        $logo = trim($_POST['logo'] ?? '');
        $vision = trim($_POST['vision'] ?? '');
        $mission = trim($_POST['mission'] ?? '');
        $goals = $_POST['goals'] ?? [];

        if ($name === '') {
            $error = 'الرجاء تعبئة اسم المنظمة.';
            require __DIR__ . '/../views/organization/create.php';
            return;
        }

        $org->create($name, $logo, $vision, $mission, $goals);

        header("Location: /oraganization-mvc/public/organization");
        exit;
    }

    function edit($id) 
    {
        $org = new Organization();
        $organization = $org->find($id);
        if (!$organization) {
            http_response_code(404);
            echo "Organization not found";
            return;
        }
        require __DIR__ . '/../views/organization/edit.php';
    }

    function update($id) 
    {
        $org = new Organization();

        $name = trim($_POST['name'] ?? '');
        $logo = trim($_POST['logo'] ?? '');
        $vision = trim($_POST['vision'] ?? '');
        $mission = trim($_POST['mission'] ?? '');
        $goals = $_POST['goals'] ?? [];

        $org->update($id, $name, $logo, $vision, $mission, $goals);

        header("Location: /oraganization-mvc/public/organization");
        exit;
    }

    function delete($id) 
    {
        $org = new Organization();
        $org->delete($id);

        header("Location: /oraganization-mvc/public/organization");
        exit;
    }

    // REST API JSON
    function apiIndex()
    {
        header('Content-Type: application/json');
        $org = new Organization();
        echo json_encode($org->all());
    }

    function apiStore()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        $org = new Organization();
        $org->create(
            $data['name'] ?? '',
            $data['logo'] ?? '',
            $data['vision'] ?? '',
            $data['mission'] ?? '',
            $data['goals'] ?? []
        );
        echo json_encode(['success' => true]);
    }

    function apiDelete($id)
    {
        header('Content-Type: application/json');
        $org = new Organization();
        $org->delete($id);
        echo json_encode(['success' => true]);
    }
}
