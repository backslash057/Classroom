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
    <title>Deconnexion - Classroom</title>
    <meta charset="UTF-8">
</head>
<body>
<?php
    if($userData == null) {
?>
        <span>You are already disconnected</span>
        <br>
        <a href='/'>Acceuil</a>
<?php
    }
    else {
?>
    <div class="output">
        You are connected as <?php echo $userData['email']; ?>
    </div>
    <button class="button">Disconnect me</button>
    
    <script src="views/static/js/logout.js"></script>
<?php
    }
?>
</body>
</html>
