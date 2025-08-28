<?php

namespace App\Controllers;

use App\Models\Message;

class MessageController
{
    // ---------------- صفحات HTML عادية ----------------

    /**
     * عرض صفحة الرسائل
     */
    public function index(): void
    {
        $message  = new Message();
        $messages = $message->all();

        require __DIR__ . '/../views/messages/index.php';
    }

    /**
     * عرض صفحة إنشاء رسالة جديدة
     */
    public function create(): void
    {
        require __DIR__ . '/../views/messages/create.php';
    }

    /**
     * حفظ رسالة جديدة
     */
    public function store(): void
    {
        $message   = new Message();
        $name      = trim($_POST['name'] ?? '');
        $email     = trim($_POST['email'] ?? '');
        $content   = trim($_POST['content'] ?? '');
        $createdAt = date('Y-m-d H:i:s');

        if ($name === '' || $email === '' || $content === '') {
            $error = "الرجاء تعبئة جميع الحقول";
            require __DIR__ . '/../views/messages/create.php';
            return;
        }

        $message->create($name, $email, $content, $createdAt);

        header("Location: /oraganization-mvc/public/messages");
        exit;
    }

    /**
     * عرض صفحة تعديل رسالة محددة
     */
    public function edit(int $id): void
    {
        $messageObj = new Message();
        $msg        = $messageObj->find($id);

        if (!$msg) {
            http_response_code(404);
            echo "Message not found";
            return;
        }

        require __DIR__ . '/../views/messages/edit.php';
    }

    /**
     * تحديث رسالة محددة
     */
    public function update(int $id): void
    {
        $message   = new Message();
        $name      = trim($_POST['name'] ?? '');
        $email     = trim($_POST['email'] ?? '');
        $content   = trim($_POST['content'] ?? '');

        $message->update($id, $name, $email, $content);

        header("Location: /oraganization-mvc/public/messages");
        exit;
    }

    /**
     * حذف رسالة محددة
     */
    public function delete(int $id): void
    {
        $message = new Message();
        $message->delete($id);

        header("Location: /oraganization-mvc/public/messages");
        exit;
    }

    // ---------------- REST API JSON ----------------

    /**
     * إرجاع جميع الرسائل بصيغة JSON
     */
    public function apiIndex(): void
    {
        header('Content-Type: application/json');

        $message = new Message();
        echo json_encode($message->all());
    }

    /**
     * عرض رسالة محددة بصيغة JSON
     */
    public function apiShow(int $id): void
    {
        header('Content-Type: application/json');

        $message = new Message();
        echo json_encode($message->find($id));
    }

    /**
     * حفظ رسالة جديدة عبر API
     */
    public function apiStore(): void
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON']);
            return;
        }

        $message = new Message();
        $message->create(
            $data['name'] ?? '',
            $data['email'] ?? '',
            $data['content'] ?? '',
            date('Y-m-d H:i:s')
        );

        echo json_encode(['success' => true]);
    }

    /**
     * تحديث رسالة محددة عبر API
     */
    public function apiUpdate(int $id): void
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON']);
            return;
        }

        $message = new Message();
        $message->update(
            $id,
            $data['name'] ?? '',
            $data['email'] ?? '',
            $data['content'] ?? ''
        );

        echo json_encode(['success' => true]);
    }

    /**
     * حذف رسالة محددة عبر API
     */
    public function apiDelete(int $id): void
    {
        header('Content-Type: application/json');

        $message = new Message();
        $message->delete($id);

        echo json_encode(['success' => true]);
    }

    /**
     * حذف جميع الرسائل عبر API
     */
    public function apiDeleteAll(): void
    {
        header("Content-Type: application/json; charset=UTF-8");

        $message = new Message();
        $all     = $message->all();

        foreach ($all as $m) {
            $message->delete((int) $m['message_id']);
        }

        echo json_encode(["status" => "success"]);
    }

    /**
     * وضع كل الرسائل الجديدة كمقروءة عبر API
     */
    public function apiMarkRead(): void
    {
        header("Content-Type: application/json; charset=UTF-8");

        $message = new Message();
        $message->markAllRead();

        echo json_encode(["status" => "success"]);
    }
}
