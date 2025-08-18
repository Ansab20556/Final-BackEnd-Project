<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> 
    <p>Here is your programs:</p>
    <ul>
    <?php
        
        foreach($programs as $program){
            echo "<li>".$program['title']."</li>";
        }
    ?>
    </ul>
</body>
</html>