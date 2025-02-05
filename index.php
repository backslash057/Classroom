<?php
require "auth.php";

$user = isset($_COOKIE["auth_token"])? decodeToken($_COOKIE["auth_token"]): null;

?>

<!DOCTYPE html>
<html lang="fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Classroom</title>
</head>
<body>
    <h1>Page d'acceuil</h1>

<?php
    if($user != null){
        echo "Bienvenue {$user['names']} {$user['surnames']}({$user['email']})";
        echo "<br>";
        echo "<a href='/logout.php'>Logout</a>";
    }
    else {
?>
    <a href="login.php">Se connecter</a><br>
    <a href="signup.php">S'inscrire</a>    
<?php
    }
?>
    <!-- <script src="/static/js/debug.js"></script> -->
</body>
</html>
