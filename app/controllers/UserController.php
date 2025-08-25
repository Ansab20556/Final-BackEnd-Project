<?php
namespace App\Controllers;

use App\Core\Response;
use App\Models\User;
use App\Core\LoggerFactory;

class UserController 
{
    private $logger;
    public function __construct() 
    {
        $this->logger = LoggerFactory::create('file'); // Factory يحدد النوع
    }
    private function getRequestData()
    {
        // جلب بيانات JSON إذا موجودة
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        // إذا مافي JSON، نرجع $_POST
        if (is_array($data)) {
            return $data;
        }
        return $_POST;
    }

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
        $data = $this->getRequestData();

        $username = $data['username'] ?? '';
        $email    = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        $role     = $data['role'] ?? 'user';

        if ($username === '' || $email === '' || $password === '') {
            if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
                http_response_code(400);
                echo json_encode(['error' => 'الرجاء تعبئة كل الحقول']);
                return;
            }
            $error = 'الرجاء تعبئة كل الحقول';
            require __DIR__ . '/../views/users/create.php';
            return;
        }

        // ------------------ Factory Logger ------------------
        $logger = \App\Core\LoggerFactory::create('file');

        $user = new User();
        $user->create($username, $email, $password, $role);

        // نسجل العملية
        $logger->log("تم إنشاء مستخدم جديد: " . $username);

        // -------------------------------------------------------

        if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
            echo json_encode(['success' => true]);
            return;
        }

        header("Location: /oraganization-mvc/public/users");
        exit;
    }

    function edit($id) 
    {
        $user = new User();
        $u = $user->find($id);
        if (!$u) {
            Response::json(['error' => 'User not found'], 404);
        }
        require __DIR__ . '/../views/users/edit.php';
    }

    function update($id) 
    {
        $data = $this->getRequestData();

        $username = $data['username'] ?? '';
        $email    = $data['email'] ?? '';
        $password = $data['password'] ?? null;
        $role     = $data['role'] ?? 'user';

        $user = new User();
        $user->update($id, $username, $email, $password, $role);

        if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
            echo json_encode(['success' => true]);
            return;
        }

        header("Location: /oraganization-mvc/public/users");
        exit;
    }

    function delete($id) 
    {
        $user = new User();
        $user->delete($id);

        if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
            echo json_encode(['success' => true]);
            return;
        }

        header("Location: /oraganization-mvc/public/users");
        exit;
    }

    // ---------------- REST API ----------------
    function apiIndex() 
    {
        header('Content-Type: application/json');
        $user = new User();
        echo json_encode($user->all());
    }

    function apiShow($id) {
        header('Content-Type: application/json');
        $user = new User();
        $u = $user->find($id);
        if(!$u) 
            {
                Response::json(['error' => 'User not found'], 404);
            }
            Response::json($u);
    }

    function apiDelete($id) 
    {
        header('Content-Type: application/json');
        $user = new User();
        $user->delete($id);
        echo json_encode(['success' => true]);
    }
    function apiUpdate($id)
    {
        header('Content-Type: application/json');
        $data = $this->getRequestData();

        $username = $data['username'] ?? '';
        $email    = $data['email'] ?? '';
        $password = $data['password'] ?? null;
        $role     = $data['role'] ?? 'user';

        $user = new User();
        $user->update($id, $username, $email, $password, $role);

        echo json_encode(['success' => true]);
    }

    function apiDeleteAll()
    {
        header('Content-Type: application/json');
        $user = new User();
        $user->deleteAll();
        echo json_encode(['success' => true]);
    }


    function apiStore() 
    {
        header('Content-Type: application/json');
        $data = $this->getRequestData();

        if(empty($data['username']) || empty($data['email']) || empty($data['password'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing fields']);
            return;
        }

        $user = new User();
        $user->create($data['username'], $data['email'], $data['password'], $data['role'] ?? 'user');
        echo json_encode(['success' => true]);
    }
    
    function apiLogin() 
    {
        header('Content-Type: application/json');
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($email) || empty($password)) 
            {
                http_response_code(400);
                echo json_encode(['error' => 'الرجاء إدخال البريد وكلمة المرور']);
                return;
            }

        $user = new \App\Models\User();
        $u = $user->findByEmail($email);

        if (!$u || !password_verify($password, $u['password'])) 
            {
                http_response_code(401);
                echo json_encode(['error' => 'البريد أو كلمة المرور غير صحيحة']);
                return;
            }

        // ترجع فقط بيانات المستخدم مع الدور
        echo json_encode([
            'id' => $u['id'],
            'username' => $u['username'],
            'role' => $u['role']
        ]);
    }
}
