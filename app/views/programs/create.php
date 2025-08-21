<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>إضافة برنامج</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <div class="max-w-xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6">إضافة برنامج جديد</h1>

            <form method="POST" action="/oraganization-mvc/public/programs" class="space-y-4 bg-white p-6 rounded-lg shadow">
                <input type="text" name="title" placeholder="العنوان" class="w-full border rounded px-3 py-2">
                <textarea name="desc" placeholder="الوصف" class="w-full border rounded px-3 py-2"></textarea>
                <input type="date" name="start_date" class="w-full border rounded px-3 py-2">
                <input type="date" name="end_date" class="w-full border rounded px-3 py-2">
                <input type="text" name="type" placeholder="النوع" class="w-full border rounded px-3 py-2">
                <input type="text" name="region" placeholder="المنطقة" class="w-full border rounded px-3 py-2">
                <div class="flex gap-3">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">إضافة</button>
                    <a href="/oraganization-mvc/public/programs" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">إلغاء</a>
                </div>
            </form>
        </div>
    </body>
</html>
