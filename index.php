<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Classroom</title>
</head>
<body>
    <h1>Page d'acceuil</h1>

<?php
    // verify authentification

    if(false){
        // echo "Bienvenue $_COOKIE['user_id')";
        // echo "Bienvenue $_COOKIE['names'] $_COOKIE['surnames']($_COOKIE['email'])";
    }
    else {
?>
    <a href="login.php">Se connecter</a><br>
    <a href="signup.php">S'inscrire</a>    
<?php
    }
?>

    <script src="/static/js/debug.js"></script>
</body>
</html>
