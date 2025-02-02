<?php

if(isset($_COOKIE["user_id"])) {
    header("Location: /login.php");
}
else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deconnexion - Classroom</title>
</head>
<body>
    <button>Me deconnecter</button>
    <script src="static/js/logout.js"></script>
</body>
</html>
    
<?php
}

?>