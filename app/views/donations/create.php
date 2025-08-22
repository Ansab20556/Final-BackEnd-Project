<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>إضافة تبرع</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <div class="max-w-xl mx-auto p-6">
            
            <form method="POST" action="/oraganization-mvc/public/donations" class="space-y-4 bg-white p-6 rounded-lg shadow">
                <h1 class="text-2xl font-bold mb-6">إضافة تبرع جديد</h1>
                <input type="text" name="donor_name" placeholder="اسم المتبرع" class="w-full border rounded px-3 py-2" required>
                <select name="donation_type" class="w-full border rounded px-3 py-2" required>
                    <option value="money">مال</option>
                    <option value="items">مواد</option>
                </select>
                <input type="number" step="0.01" name="amount" placeholder="القيمة" class="w-full border rounded px-3 py-2">
                <input type="text" name="item_description" placeholder="الوصف" class="w-full border rounded px-3 py-2">
                <input type="date" name="donation_date" class="w-full border rounded px-3 py-2" required>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="confirmed" value="1">
                    تم التأكيد
                </label>

                <div class="flex gap-3">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">إضافة</button>
                    <a href="/oraganization-mvc/public/donations" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">إلغاء</a>
                </div>
            </form>
        </div>
    </body>
</html>