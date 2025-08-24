<?php
namespace App\Controllers;

use App\Models\Program;

class ProgramController 
{
    function index() 
    {
        $program = new Program();
        $programs = $program->all();
        require __DIR__ . '/../views/programs/index.php';
    }

    function create() 
    {
        require __DIR__ . '/../views/programs/create.php';
    }

    function store() 
    {
        $program = new Program();
        $title = trim($_POST['title'] ?? '');
        $descrip = trim($_POST['desc'] ?? '');
        $start_date = trim($_POST['start_date'] ?? '');
        $end_date = trim($_POST['end_date'] ?? '');
        $type = trim($_POST['type'] ?? '');
        $region = trim($_POST['region'] ?? '');

        if ($title === '' || $descrip === '' || $start_date === '' || $end_date === '' || $type === '' || $region === '') {
            $error = 'الرجاء تعبئة كل الحقول.';
            require __DIR__ . '/../views/programs/create.php';
            return;
        }

        $program->create($title, $descrip, $start_date, $end_date, $type, $region);

        header("Location: /oraganization-mvc/public/programs");
        exit;
    }

    function edit($id) 
    {
        $program = new Program();
        $prog = $program->find($id);
        if (!$prog) {
            http_response_code(404);
            echo "Program not found";
            return;
        }
        require __DIR__ . '/../views/programs/edit.php';
    }

    function update($id) 
    {
        $program = new Program();
        $data = $_POST;
        if (empty($data) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
            $data = json_decode(file_get_contents("php://input"), true);
        }
        $program->update(
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

    function delete($id) 
    {
        $program = new Program();
        $program->delete($id);

        header("Location: /oraganization-mvc/public/programs");
        exit;
    }

    // REST API

    function apiIndex() 
    {
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        $program = new Program();
        echo json_encode([
            "status" => "success",
            "data" => $program->all()
        ]);
    }

    function apiShow($id) 
    {
        header("Content-Type: application/json; charset=UTF-8");
        $program = new Program();
        $prog = $program->find($id);
        if ($prog) 
            {
                echo json_encode(["status" => "success", "data" => $prog]);
            } 
            else 
            {
                http_response_code(404);
                echo json_encode(["status" => "error", "message" => "Program not found"]);
            }
    }

    function apiStore() 
    {
        header("Content-Type: application/json; charset=UTF-8");
        $program = new Program();
        $data = json_decode(file_get_contents("php://input"), true);

        $program->create(
            $data['title'] ?? '',
            $data['descrip'] ?? '',
            $data['startt_date'] ?? '',
            $data['end_date'] ?? '',
            $data['typ'] ?? '',
            $data['region'] ?? ''
        );
        echo json_encode(["status" => "success"]);
    }

    function apiUpdate($id) 
    {
        header("Content-Type: application/json; charset=UTF-8");
        $program = new Program();
        $data = json_decode(file_get_contents("php://input"), true);

        $program->update(
            $id,
            $data['title'] ?? '',
            $data['descrip'] ?? '',
            $data['startt_date'] ?? '',
            $data['end_date'] ?? '',
            $data['typ'] ?? '',
            $data['region'] ?? ''
        );
        echo json_encode(["status" => "success"]);
    }

    function apiDelete($id) 
    {
        header('Content-Type: application/json');
        $program = new Program();
        $program->delete($id);
        echo json_encode(['success' => true]);
    }

    function apiDeleteAll() 
    {
        header("Content-Type: application/json; charset=UTF-8");
        $program = new Program();
        $all = $program->all();
        foreach($all as $p) {
            $program->delete($p['program_id']);
        }
        echo json_encode(["status" => "success"]);
    }
    }
