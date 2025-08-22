<?php

namespace App\Models;

use App\Core\App;

class Organization 
{

    function all() 
    {
        $stm = App::db()->prepare("SELECT * FROM organization");
        $stm->execute();
        return $stm->fetchAll();
    }

    function find($id) 
    {
        $stm = App::db()->prepare("SELECT * FROM organization WHERE id = :id");
        $stm->execute(['id' => $id]);
        return $stm->fetch();
    }

    function create($name, $logo, $vision, $mission, $goals) 
    {
        $stm = App::db()->prepare("INSERT INTO organization (name, logo, vision, mission, goals)
                                   VALUES (:name, :logo, :vision, :mission, :goals)");
        $stm->execute([
            'name' => $name,
            'logo' => $logo,
            'vision' => $vision,
            'mission' => $mission,
            'goals' => json_encode($goals, JSON_UNESCAPED_UNICODE)
        ]);
    }

    function update($id, $name, $logo, $vision, $mission, $goals) 
    {
        $stm = App::db()->prepare("UPDATE organization
                                   SET name = :name,
                                       logo = :logo,
                                       vision = :vision,
                                       mission = :mission,
                                       goals = :goals
                                   WHERE id = :id");
        return $stm->execute([
            'id' => $id,
            'name' => $name,
            'logo' => $logo,
            'vision' => $vision,
            'mission' => $mission,
            'goals' => json_encode($goals, JSON_UNESCAPED_UNICODE)
        ]);
    }

    function delete($id) 
    {
        $stm = App::db()->prepare("DELETE FROM organization WHERE id = :id");
        $stm->execute(['id' => $id]);
    }
}
