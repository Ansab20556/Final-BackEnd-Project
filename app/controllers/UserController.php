<?php
namespace App\Controllers;

use App\Models\User;

class UserController 
{

    function index() 
    {
        $user = new User();
        $users = $user->all();
        require __DIR__ . '/../views/users/index.php';
    }

    function create() 
    {
        require __DIR__ . '/../views/users/create.php';
    }

    function store() 
    {
        $user = new User();
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'user';

        if ($username === '' || $email === '' || $password === '') 
            {
                $error = 'الرجاء تعبئة كل الحقول';
                require __DIR__ . '/../views/users/create.php';
                return;
            }

        $user->create($username, $email, $password, $role);
        header("Location: /oraganization-mvc/public/users");
        exit;
    }

    function edit($id) 
    {
        $user = new User();
        $u = $user->find($id);
        if (!$u) 
            {
                http_response_code(404);
                echo "User not found";
                return;
            }
        require __DIR__ . '/../views/users/edit.php';
    }

    function update($id) 
    {
        $user = new User();
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'user';

        $user->update($id, $username, $email, $password, $role);
        header("Location: /oraganization-mvc/public/users");
        exit;
    }

    function delete($id) 
    {
        $user = new User();
        $user->delete($id);
        header("Location: /oraganization-mvc/public/users");
        exit;
    }



}
