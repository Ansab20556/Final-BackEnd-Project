<?php

namespace App\Controllers;

use App\Core\Response;
use App\Models\User;
use App\Core\LoggerFactory;

class UserController
{
    private $logger;

    /**
     * إنشاء الكائن Logger عبر Factory
     */
    public function __construct()
    {
        $this->logger = LoggerFactory::create('file');
    }

    /**
     * جلب بيانات الطلب سواء POST أو JSON
     */
    private function getRequestData(): array
    {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        return is_array($data) ? $data : $_POST;
    }

    // ---------------- صفحات HTML عادية ----------------

    /**
     * عرض صفحة المستخدمين
     */
    public function index(): void
    {
        $user  = new User();
        $users = $user->all();

        require __DIR__ . '/../views/users/index.php';
    }

    /**
     * عرض صفحة إنشاء مستخدم جديد
     */
    public function create(): void
    {
        require __DIR__ . '/../views/users/create.php';
    }

    /**
     * حفظ مستخدم جديد
     */
    public function store(): void
    {
        $data     = $this->getRequestData();
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

        $user = new User();
        $user->create($username, $email, $password, $role);

        $this->logger->log("تم إنشاء مستخدم جديد: " . $username);

        if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
            echo json_encode(['success' => true]);
            return;
        }

        header("Location: /oraganization-mvc/public/users");
        exit;
    }

    /**
     * عرض صفحة تعديل مستخدم محدد
     */
    public function edit(int $id): void
    {
        $userObj = new User();
        $user    = $userObj->find($id);

        if (!$user) {
            Response::json(['error' => 'User not found'], 404);
        }

        require __DIR__ . '/../views/users/edit.php';
    }

    /**
     * تحديث مستخدم محدد
     */
    public function update(int $id): void
    {
        $data     = $this->getRequestData();
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

    /**
     * حذف مستخدم محدد
     */
    public function delete(int $id): void
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

    /**
     * إرجاع جميع المستخدمين بصيغة JSON
     */
    public function apiIndex(): void
    {
        header('Content-Type: application/json');

        $user = new User();
        echo json_encode($user->all());
    }

    /**
     * عرض مستخدم محدد بصيغة JSON
     */
    public function apiShow(int $id): void
    {
        header('Content-Type: application/json');

        $userObj = new User();
        $user    = $userObj->find($id);

        if (!$user) {
            Response::json(['error' => 'User not found'], 404);
            return;
        }

        Response::json($user);
    }

    /**
     * حذف مستخدم محدد عبر API
     */
    public function apiDelete(int $id): void
    {
        header('Content-Type: application/json');

        $user = new User();
        $user->delete($id);

        echo json_encode(['success' => true]);
    }

    /**
     * تحديث مستخدم محدد عبر API
     */
    public function apiUpdate(int $id): void
    {
        header('Content-Type: application/json');

        $data     = $this->getRequestData();
        $username = $data['username'] ?? '';
        $email    = $data['email'] ?? '';
        $password = $data['password'] ?? null;
        $role     = $data['role'] ?? 'user';

        $user = new User();
        $user->update($id, $username, $email, $password, $role);

        echo json_encode(['success' => true]);
    }

    /**
     * حذف جميع المستخدمين عبر API
     */
    public function apiDeleteAll(): void
    {
        header('Content-Type: application/json');

        $user = new User();
        $user->deleteAll();

        echo json_encode(['success' => true]);
    }

    /**
     * حفظ مستخدم جديد عبر API
     */
    public function apiStore(): void
    {
        header('Content-Type: application/json');

        $data = $this->getRequestData();

        if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing fields']);
            return;
        }

        $user = new User();
        $user->create(
            $data['username'],
            $data['email'],
            $data['password'],
            $data['role'] ?? 'user'
        );

        echo json_encode(['success' => true]);
    }

    /**
     * تسجيل دخول المستخدم عبر API
     */
    public function apiLogin(): void
    {
        header('Content-Type: application/json');

        $data  = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($email) || empty($password)) {
            http_response_code(400);
            echo json_encode(['error' => 'الرجاء إدخال البريد وكلمة المرور']);
            return;
        }

        $userObj = new User();
        $user    = $userObj->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            http_response_code(401);
            echo json_encode(['error' => 'البريد أو كلمة المرور غير صحيحة']);
            return;
        }

        echo json_encode([
            'id'       => $user['id'],
            'username' => $user['username'],
            'role'     => $user['role']
        ]);
    }
}
