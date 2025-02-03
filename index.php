<?php
require "auth.php";

$user = null;
if(isset($_COOKIE["auth_token"])) {
    $token = $_COOKIE["auth_token"];
    $playload = decodeToken($_COOKIE["auth_token"]);
    
    // TODO: verify if the token is not expired before
    $user = $playload;

}
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
    if($user != null){
        echo "Bienvenue $user['names'] $user['surnames']($user['email'])";
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
