<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>التبرعات</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
            <h1 class="text-2xl font-bold mb-6">قائمة التبرعات</h1>
            <a href="/oraganization-mvc/public/donations/create" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">+ تبرع جديد</a>

            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th class="py-3 px-4 text-right">#</th>
                            <th class="py-3 px-4 text-right">اسم المتبرع</th>
                            <th class="py-3 px-4 text-right">نوع التبرع</th>
                            <th class="py-3 px-4 text-right">القيمة</th>
                            <th class="py-3 px-4 text-right">الوصف</th>
                            <th class="py-3 px-4 text-right">تاريخ التبرع</th>
                            <th class="py-3 px-4 text-right">تم التأكيد؟</th>
                            <th class="py-3 px-4 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($donations as $don): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4"><?= $don['donation_id'] ?></td>
                            <td class="py-2 px-4"><?= htmlspecialchars($don['donor_name']) ?></td>
                            <td class="py-2 px-4"><?= $don['donation_type'] ?></td>
                            <td class="py-2 px-4"><?= $don['amount'] ?></td>
                            <td class="py-2 px-4"><?= htmlspecialchars($don['item_description']) ?></td>
                            <td class="py-2 px-4"><?= $don['donation_date'] ?></td>
                            <td class="py-2 px-4"><?= $don['confirmed'] ? "✅" : "❌" ?></td>
                            <td class="py-2 px-4 flex gap-2 justify-center">
                                <a href="/oraganization-mvc/public/donations/<?= $don['donation_id'] ?>/edit" class="px-3 py-1 bg-amber-500 text-white rounded hover:bg-amber-600">تعديل</a>
                                
                                <form method="POST" action="/oraganization-mvc/public/donations/<?= $don['donation_id'] ?>" 
                                    style="display:inline;" 
                                    onsubmit="return confirm('هل تريد حذف هذا التبرع؟');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded">حذف</button>
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
