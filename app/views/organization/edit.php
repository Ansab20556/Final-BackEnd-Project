<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>تعديل المنظمة</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
            <div class="max-w-xl mx-auto p-6 bg-white rounded shadow mt-10">
                <h1 class="text-2xl font-bold mb-6">تعديل بيانات المنظمة</h1>

                <form method="POST" action="/oraganization-mvc/public/organization/<?= $organization['id'] ?>">
                    <input type="hidden" name="_method" value="PUT">

                    <input type="text" name="name" value="<?= htmlspecialchars($organization['name']) ?>" class="w-full border p-2 mb-3">
                    <input type="text" name="logo" value="<?= htmlspecialchars($organization['logo']) ?>" class="w-full border p-2 mb-3">
                    <textarea name="vision" class="w-full border p-2 mb-3"><?= htmlspecialchars($organization['vision']) ?></textarea>
                    <textarea name="mission" class="w-full border p-2 mb-3"><?= htmlspecialchars($organization['mission']) ?></textarea>
                    <textarea name="goals[]" class="w-full border p-2 mb-3"><?= htmlspecialchars($organization['goals']) ?></textarea>

                    <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded">تحديث</button>
                    <a href="/oraganization-mvc/public/organization"
                    class="px-4 py-2 bg-gray-300 rounded">إلغاء</a>
                </form>
            </div>
    </body>
</html>
