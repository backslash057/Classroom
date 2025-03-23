<?php

    $compName = "{$userData["names"]} {$userData["surnames"]}({$userData["email"]})";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Classroom</title>
</head>
<body>
    <h2>Welcome <?php echo $compName ?></h2>

    <a href="/logout">Log out</a>
</body>
</html>