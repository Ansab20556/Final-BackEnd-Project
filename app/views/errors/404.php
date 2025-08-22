<?php
http_response_code(404);
?>
<!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>صفحة غير موجودة</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-red-600 mb-4">404</h1>
            <p class="text-2xl mb-6">الصفحة التي تبحث عنها غير موجودة</p>
            <a href="/oraganization-mvc/public/users"
            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            العودة 
            </a>
        </div>
    </body>
</html>
