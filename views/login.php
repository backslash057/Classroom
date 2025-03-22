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
    <title>Connexion - Classroom</title>
</head>
<body>
    <h1>Connexion</h1>

    <div class="error_frame"></div>   <!-- dinamically display the error here -->
    <form action="/login" method="POST" class="form">
        <table style="border: 1px solid black">
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" class="email" required></td>
            </tr>
            <tr>
                <!-- TODO: add a button to reveal the password -->
                <td>Mot de passe</td>
                <td><input type="password" name="password" class="password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="submit" value="Se connecter"></td>
            </tr>
        </table>
    </form>
    <br>
    <span>Pas encore de compte?</span>
    <a href="/signup">S'inscrire</a>

    <!-- <script src="/static/js/debug.js"></script> -->
    <script src="views/static/js/login.js"></script>
</body>
</html>
