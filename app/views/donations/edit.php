<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>تعديل تبرع</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <div class="max-w-xl mx-auto p-6">
            <form method="POST" action="/oraganization-mvc/public/donations/<?= $don['donation_id'] ?>">
                <input type="hidden" name="_method" value="PUT">
                <h1 class="text-2xl font-bold mb-6">تعديل التبرع</h1>

                <input type="text" name="donor_name" value="<?= htmlspecialchars($don['donor_name']) ?>" class="w-full border rounded px-3 py-2" required>
                <select name="donation_type" class="w-full border rounded px-3 py-2" required>
                    <option value="money" <?= $don['donation_type']=='money'?'selected':'' ?>>مال</option>
                    <option value="items" <?= $don['donation_type']=='items'?'selected':'' ?>>مواد</option>
                </select>
                <input type="number" step="0.01" name="amount" value="<?= $don['amount'] ?>" class="w-full border rounded px-3 py-2">
                <input type="text" name="item_description" value="<?= htmlspecialchars($don['item_description']) ?>" class="w-full border rounded px-3 py-2">
                <input type="date" name="donation_date" value="<?= $don['donation_date'] ?>" class="w-full border rounded px-3 py-2">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="confirmed" value="1" <?= $don['confirmed']?'checked':'' ?>>
                    تم التأكيد
                </label>

                <div class="flex gap-3">
                    <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600">تحديث</button>
                    <a href="/oraganization-mvc/public/donations" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">إلغاء</a>
                </div>
            </form>
        </div>
    </body>
</html>
