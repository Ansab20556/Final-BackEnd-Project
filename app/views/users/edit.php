<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>تعديل المستخدم</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
            <h1 class="text-2xl font-bold mb-4">تعديل المستخدم</h1>
            <form method="POST" action="/oraganization-mvc/public/users/<?= $u['id'] ?>" class="space-y-4">
                <input type="hidden" name="_method" value="PUT">

                <input type="text" name="username" value="<?= htmlspecialchars($u['username']) ?>" placeholder="اسم المستخدم" class="w-full border px-3 py-2 rounded">
                <input type="email" name="email" value="<?= htmlspecialchars($u['email']) ?>" class="w-full border px-3 py-2 rounded">
                <input type="password" name="password" placeholder="كلمة المرور الجديدة (اختياري)" class="w-full border px-3 py-2 rounded">
                <select name="role" class="w-full border px-3 py-2 rounded">
                    <option value="user" <?= $u['role']=='user'?'selected':'' ?>>User</option>
                    <option value="admin" <?= $u['role']=='admin'?'selected':'' ?>>Admin</option>
                </select>
                <div class="flex gap-3">
                    <button type="submit" class="bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-600">تحديث</button>
                    <a href="/oraganization-mvc/public/users" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">إلغاء</a>
                </div>
            </form>
        </div>
    </body>
</html>
