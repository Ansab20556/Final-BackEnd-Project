<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>المنظمة</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
        
    <body class="bg-gray-100">
        <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
            <h1 class="text-2xl font-bold mb-6">بيانات المنظمة</h1>

            <a href="/oraganization-mvc/public/organization/create"
            class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">+ إضافة منظمة</a>

            <table class="min-w-full border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">الاسم</th>
                        <th class="px-4 py-2">الرؤية</th>
                        <th class="px-4 py-2">الرسالة</th>
                        <th class="px-4 py-2">الأهداف</th>
                        <th class="px-4 py-2">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($organizations as $org): ?>
                    <tr class="border-b">
                        <td class="px-4 py-2"><?= $org['id'] ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($org['name']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($org['vision']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($org['mission']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($org['goals']) ?></td>
                        <td class="px-4 py-2">
                            <a href="/oraganization-mvc/public/organization/<?= $org['id'] ?>/edit"
                            class="px-2 py-1 bg-amber-500 text-white rounded">تعديل</a>
                            <form action="/oraganization-mvc/public/organization/<?= $org['id'] ?>/delete"
                                method="POST" class="inline"
                                onsubmit="return confirm('هل تريد حذف المنظمة؟');">
                                <button class="px-2 py-1 bg-red-600 text-white rounded">حذف</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
