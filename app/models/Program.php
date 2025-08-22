<?php

namespace App\Models;

use App\Core\App;

class Program 
{

    function all() 
    {
        $stm = App::db()->prepare("SELECT * FROM programs");
        $stm->execute();
        return $stm->fetchAll();
    }

    function find($id) 
    {
        $stm = App::db()->prepare("SELECT * FROM programs WHERE program_id = :id");
        $stm->execute(['id' => $id]);
        return $stm->fetch();
    }

    function create($title, $descrip, $start_date, $end_date, $type, $region) 
    {
        $stm = App::db()->prepare("INSERT INTO programs(title, descrip, startt_date, end_date, typ, region)
                                   VALUES(:title, :descrip, :startt_date, :end_date, :typ, :region)");
        $stm->execute([
            'title' => $title,
            'descrip' => $descrip,
            'startt_date' => $start_date,
            'end_date' => $end_date,
            'typ' => $type,
            'region' => $region
        ]);
    }

    function update($id, $title, $descrip, $start_date, $end_date, $type, $region) 
    {
        $stm = App::db()->prepare("UPDATE programs
                                   SET title = :title,
                                       descrip = :descrip,
                                       startt_date = :startt_date,
                                       end_date = :end_date,
                                       typ = :typ,
                                       region = :region
                                   WHERE program_id = :id");
        return $stm->execute([
            'title' => $title,
            'descrip' => $descrip,
            'startt_date' => $start_date,
            'end_date' => $end_date,
            'typ' => $type,
            'region' => $region,
            'id' => $id
        ]);
    }

    function delete($id) 
    {
        $stm = App::db()->prepare("DELETE FROM programs WHERE program_id = :id");
        $stm->execute(['id' => $id]);
    }
}
