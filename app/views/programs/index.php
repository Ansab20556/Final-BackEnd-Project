
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>البرامج</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">قائمة البرامج</h1>

    <a href="/oraganization-mvc/public/programs/create" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">+ برنامج جديد</a>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-200 text-gray-800">
                <tr>
                    <th class="py-3 px-4 text-right">#</th>
                    <th class="py-3 px-4 text-right">العنوان</th>
                    <th class="py-3 px-4 text-right">الوصف</th>
                    <th class="py-3 px-4 text-right">تاريخ البداية</th>
                    <th class="py-3 px-4 text-right">تاريخ النهاية</th>
                    <th class="py-3 px-4 text-right">النوع</th>
                    <th class="py-3 px-4 text-right">المنطقة</th>
                    <th class="py-3 px-4 text-center">إجراءات</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($programs as $prog): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4"><?= $prog['program_id'] ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($prog['title']) ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($prog['descrip']) ?></td>
                    <td class="py-2 px-4"><?= $prog['startt_date'] ?></td>
                    <td class="py-2 px-4"><?= $prog['end_date'] ?></td>
                    <td class="py-2 px-4"><?= $prog['typ'] ?></td>
                    <td class="py-2 px-4"><?= $prog['region'] ?></td>
                    <td class="py-2 px-4 flex gap-2 justify-center">
                        <a href="/oraganization-mvc/public/programs/<?= $prog['program_id'] ?>/edit" class="px-3 py-1 bg-amber-500 text-white rounded hover:bg-amber-600">تعديل</a>
                        <form method="POST" action="/oraganization-mvc/public/programs/<?= $prog['program_id'] ?>/delete" onsubmit="return confirm('هل تريد حذف هذا البرنامج؟');">
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
