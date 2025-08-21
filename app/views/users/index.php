<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>قائمة المستخدمين</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">قائمة المستخدمين</h1>
    <a href="/oraganization-mvc/public/users/create" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ مستخدم جديد</a>

    <div class="overflow-x-auto">
        <table class="min-w-full text-right border">
            <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">اسم المستخدم</th>
                <th class="px-4 py-2 border">البريد الإلكتروني</th>
                <th class="px-4 py-2 border">الدور</th>
                <th class="px-4 py-2 border text-center">إجراءات</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($users as $u): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border"><?= $u['id'] ?></td>
                    <td class="px-4 py-2 border"><?= htmlspecialchars($u['username']) ?></td>
                    <td class="px-4 py-2 border"><?= htmlspecialchars($u['email']) ?></td>
                    <td class="px-4 py-2 border"><?= htmlspecialchars($u['role']) ?></td>
                    <td class="px-4 py-2 border flex gap-2 justify-center">
                        <a href="/oraganization-mvc/public/users/<?= $u['id'] ?>/edit" class="px-3 py-1 bg-amber-500 text-white rounded hover:bg-amber-600">تعديل</a>
                        <form method="POST" action="/oraganization-mvc/public/users/<?= $u['id'] ?>/delete" onsubmit="return confirm('هل تريد حذف هذا المستخدم؟');">
                            <button type="submit" class="px-3 py-1 bg-rose-600 text-white rounded hover:bg-rose-700">حذف</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
