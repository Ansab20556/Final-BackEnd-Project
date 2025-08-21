<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
      <meta charset="UTF-8">
      <title>تعديل برنامج</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100">
      <div class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">تعديل البرنامج</h1>

        <form method="POST" action="/oraganization-mvc/public/programs/<?= $prog['program_id'] ?>/update" class="space-y-4 bg-white p-6 rounded-lg shadow">
          <input type="text" name="title" value="<?= htmlspecialchars($prog['title']) ?>" class="w-full border rounded px-3 py-2" placeholder="العنوان">
          <textarea name="desc" class="w-full border rounded px-3 py-2" placeholder="الوصف"><?= htmlspecialchars($prog['descrip']) ?></textarea>
          <input type="date" name="start_date" value="<?= $prog['startt_date'] ?>" class="w-full border rounded px-3 py-2">
          <input type="date" name="end_date" value="<?= $prog['end_date'] ?>" class="w-full border rounded px-3 py-2">
          <input type="text" name="type" value="<?= htmlspecialchars($prog['typ']) ?>" class="w-full border rounded px-3 py-2" placeholder="النوع">
          <input type="text" name="region" value="<?= htmlspecialchars($prog['region']) ?>" class="w-full border rounded px-3 py-2" placeholder="المنطقة">
          <div class="flex gap-3">
            <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600">تحديث</button>
            <a href="/oraganization-mvc/public/programs" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">إلغاء</a>
          </div>
        </form>
      </div>
  </body>
</html>
