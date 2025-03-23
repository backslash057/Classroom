<?php

    $compName = "{$userData["names"]} {$userData["surnames"]}({$userData["email"]})";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | classroom</title>
</head>
<body>
    <h2>Teacher page</h2>
    <h2>Welcome <?php echo $compName ?></h2>

    <a href="/logout">Log out</a>
</body>
</html>