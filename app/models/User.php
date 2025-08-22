<?php
namespace App\Models;

use App\Core\App;

class User 
{

    public function findByEmail($email) 
    {
        $stmt = App::db()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    function all() 
    {
        $stm = App::db()->prepare("SELECT * FROM users");
        $stm->execute();
        return $stm->fetchAll();
    }

    function find($id) 
    {
        $stm = App::db()->prepare("SELECT * FROM users WHERE id = :id");
        $stm->execute(['id' => $id]);
        return $stm->fetch();
    }

    function create($username, $email, $password, $role) 
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stm = App::db()->prepare("INSERT INTO users(username, email, password, role) VALUES(:username, :email, :password, :role)");
        $stm->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role
        ]);
    }

    function update($id, $username, $email, $password, $role) 
    {
        $stm = App::db()->prepare("UPDATE users SET username = :username, email = :email, password = :password, role = :role WHERE id = :id");
        $stm->execute([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
            'id' => $id
        ]);
    }

    function delete($id) 
    {
        $stm = App::db()->prepare("DELETE FROM users WHERE id = :id");
        $stm->execute(['id' => $id]);
    }
}
