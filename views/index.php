<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/authController.php";


// Try, load and verify the user datas from his cookies
$controller = new Authcontroller();
$userData = $controller->checkAuthentification();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil - Classroom</title>
</head>
<body>
    <h1>Page d'acceuil</h1>

<?php
    if($userData != null){
        var_dump($userData);
        echo "Bienvenue {$userData['email']}";
        echo "<br>";
        echo "<a href='/logout'>Logout</a>";
    }
    else {
?>
    <a href="/login">Se connecter</a><br>
    <a href="/signup">S'inscrire</a>    
<?php
    }
?>
</body>
</html>
