<?php
namespace App\Controllers;

use App\Models\Message;

class MessageController
{
    // ---------------- صفحات HTML عادية ----------------
    function index()
    {
        $message = new Message();
        $messages = $message->all();
        require __DIR__ . '/../views/messages/index.php';
    }

    function create()
    {
        require __DIR__ . '/../views/messages/create.php';
    }

    function store()
    {
        $message = new Message();

        $name    = trim($_POST['name'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $created_at = date('Y-m-d H:i:s');

        if ($name === '' || $email === '' || $content === '') {
            $error = "الرجاء تعبئة جميع الحقول";
            require __DIR__ . '/../views/messages/create.php';
            return;
        }

        $message->create($name, $email, $content, $created_at);

        header("Location: /oraganization-mvc/public/messages");
        exit;
    }

    function edit($id)
    {
        $message = new Message();
        $msg = $message->find($id);
        if (!$msg) {
            http_response_code(404);
            echo "Message not found";
            return;
        }
        require __DIR__ . '/../views/messages/edit.php';
    }

    function update($id)
    {
        $message = new Message();

        $name    = trim($_POST['name'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $content = trim($_POST['content'] ?? '');

        $message->update($id, $name, $email, $content);

        header("Location: /oraganization-mvc/public/messages");
        exit;
    }

    function delete($id)
    {
        $message = new Message();
        $message->delete($id);
        header("Location: /oraganization-mvc/public/messages");
        exit;
    }

    // ---------------- REST API JSON ----------------
    function apiIndex()
    {
        header('Content-Type: application/json');
        $message = new Message();
        echo json_encode($message->all());
    }

    function apiShow($id)
    {
        header('Content-Type: application/json');
        $message = new Message();
        echo json_encode($message->find($id));
    }

    function apiStore()
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

    function apiUpdate($id)
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

    function apiDelete($id)
    {
        header('Content-Type: application/json');
        $message = new Message();
        $message->delete($id);
        echo json_encode(['success' => true]);
    }

    function apiDeleteAll()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $message = new Message();
        $all = $message->all();
        foreach ($all as $m) {
            $message->delete($m['message_id']);
        }
        echo json_encode(["status" => "success"]);
    }
}
