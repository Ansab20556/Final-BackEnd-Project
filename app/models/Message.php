<?php

namespace App\Models;

use App\Core\App;

class Message
{
    function all()
    {
        $stm = App::db()->prepare("SELECT * FROM messages ORDER BY created_at DESC");
        $stm->execute();
        return $stm->fetchAll();
    }

    function find($id)
    {
        $stm = App::db()->prepare("SELECT * FROM messages WHERE message_id = :id");
        $stm->execute(['id' => $id]);
        return $stm->fetch();
    }

    function create($name, $email, $content, $created_at)
    {
        $stm = App::db()->prepare("INSERT INTO messages 
            (name, email, content, created_at)
            VALUES (:name, :email, :content, :created_at)");
        $stm->execute([
            'name'       => $name,
            'email'      => $email,
            'content'    => $content,
            'created_at' => $created_at
        ]);
    }

    function update($id, $name, $email, $content)
    {
        $stm = App::db()->prepare("UPDATE messages SET
            name = :name,
            email = :email,
            content = :content
            WHERE message_id = :id");
        $stm->execute([
            'name'    => $name,
            'email'   => $email,
            'content' => $content,
            'id'      => $id
        ]);
    }

    function delete($id)
    {
        $stm = App::db()->prepare("DELETE FROM messages WHERE message_id = :id");
        $stm->execute(['id' => $id]);
    }
}
