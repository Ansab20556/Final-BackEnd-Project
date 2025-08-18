<?php

namespace App\Controllers;

use App\Models\Program;

class ProgramController{

    function index(){
        $program=new Program();

        $programs=$program->all();
        // echo"1";
        require __DIR__.'/../views/programs/index.php';

    }

    function show(){

    }

    function create(){
        require __DIR__.'/../views/Programs/create.php';
    }

    function store(){
        $program =new Program();
        
        $program->create($_POST['title'],$_POST['desc'],
                        $_POST['start_date'],$_POST['end_date'],
                        $_POST['type'],$_POST['region']);

        $this->index();
    }
}