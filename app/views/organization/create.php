<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>إضافة منظمة</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <div class="max-w-xl mx-auto p-6 bg-white rounded shadow mt-10">
            <h1 class="text-2xl font-bold mb-6">إضافة منظمة جديدة</h1>

            <form method="POST" action="/oraganization-mvc/public/organization">
                <input type="text" name="name" placeholder="اسم المنظمة" class="w-full border p-2 mb-3">
                <input type="text" name="logo" placeholder="رابط الشعار" class="w-full border p-2 mb-3">
                <textarea name="vision" placeholder="الرؤية" class="w-full border p-2 mb-3"></textarea>
                <textarea name="mission" placeholder="الرسالة" class="w-full border p-2 mb-3"></textarea>
                <textarea name="goals[]" placeholder="الأهداف (اكتب هدف واحد لكل سطر)" class="w-full border p-2 mb-3"></textarea>

                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">حفظ</button>
                <a href="/oraganization-mvc/public/organization"
                class="px-4 py-2 bg-gray-300 rounded">إلغاء</a>
            </form>
        </div>
    </body>
</html>
