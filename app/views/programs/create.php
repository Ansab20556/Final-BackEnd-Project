<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="/oraganization-mvc/public/programs">
        <input type="text" name="title" id="" placeholder="Enter your Title">
        <textarea name="desc" id="" placeholder="Enter the program description">
        </textarea>
        <input type="date" name="start_date">
        <input type="date" name="end_date">
        <input type="text" name="type" placeholder="Enter the type">
        <input type="text" name="region" placeholder="Enter the region">
        <input type="submit" value="Send">
    </form>
</body>
</html>