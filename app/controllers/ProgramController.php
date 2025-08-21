<?php 

namespace App\Controllers;

use App\Models\Program;

class ProgramController {

    function index() {
        $program = new Program();
        $programs = $program->all();
        require __DIR__ . '/../views/programs/index.php';
    }

    function create() {
        require __DIR__ . '/../views/programs/create.php';
    }

    function store() {
        $program = new Program();

        $title = trim($_POST['title'] ?? '');
        $descrip = trim($_POST['desc'] ?? '');
        $start_date = trim($_POST['start_date'] ?? '');
        $end_date = trim($_POST['end_date'] ?? '');
        $type = trim($_POST['type'] ?? '');
        $region = trim($_POST['region'] ?? '');

        if ($title === '' || $descrip === '' || $start_date === '' ||
            $end_date === '' || $type === '' || $region === '') {
            $error = 'الرجاء تعبئة كل الحقول.';
            require __DIR__ . '/../views/programs/create.php';
            return;
        }

        $program->create($title, $descrip, $start_date, $end_date, $type, $region);

        header("Location: /oraganization-mvc/public/programs");
        exit;
    }

    function edit($id) {
        $program = new Program();
        $prog = $program->find($id);

        if (!$prog) {
            http_response_code(404);
            echo "Program not found";
            return;
        }

        require __DIR__ . '/../views/programs/edit.php';
    }

    function update($id) {
        $program = new Program();

        $title = trim($_POST['title'] ?? '');
        $descrip = trim($_POST['desc'] ?? '');
        $start_date = trim($_POST['start_date'] ?? '');
        $end_date = trim($_POST['end_date'] ?? '');
        $type = trim($_POST['type'] ?? '');
        $region = trim($_POST['region'] ?? '');

        $program->update($id, $title, $descrip, $start_date, $end_date, $type, $region);

        header("Location: /oraganization-mvc/public/programs");
        exit;
    }

    function delete($id) {
        $program = new Program();
        $program->delete($id);

        header("Location: /oraganization-mvc/public/programs");
        exit;
    }
}
