<?php
namespace App\Controllers;

use App\Core\App;

class AuthController 
{
    public function login() 
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");


        // استقبل البيانات من الطلب
        $data = json_decode(file_get_contents("php://input"), true);

        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $stmt = App::db()->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) 
            {
                // نجاح تسجيل الدخول
                echo json_encode([
                    'token' => bin2hex(random_bytes(16)),
                    'role' => $user['role']
                ]);
            } 
        else 
        {
            http_response_code(401);
            echo json_encode(['error' => 'البريد أو كلمة المرور غير صحيحة']);
        }
    }
}
