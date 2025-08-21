<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة مستخدم جديد</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">إضافة مستخدم جديد</h1>
    <?php if(!empty($error)): ?>
        <p class="text-red-500 mb-4"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" action="/oraganization-mvc/public/users" class="space-y-4">
        <input type="text" name="username" placeholder="اسم المستخدم" class="w-full border px-3 py-2 rounded">
        <input type="email" name="email" placeholder="البريد الإلكتروني" class="w-full border px-3 py-2 rounded">
        <input type="password" name="password" placeholder="كلمة المرور" class="w-full border px-3 py-2 rounded">
        <select name="role" class="w-full border px-3 py-2 rounded">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <div class="flex gap-3">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">إضافة</button>
            <a href="/oraganization-mvc/public/users" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">إلغاء</a>
        </div>
    </form>
</div>
</body>
</html>

