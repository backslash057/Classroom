<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Connexion</h1>

    <form action="/" method="POST">
        <table>
            <tr>
                <td>Noms</td>
                <td><input type="text" class="names"></td>
            </tr>
            <tr>
                <td>Prenoms</td>
                <td><input type="text" class="surnames"></td>
            </tr>
            <tr>
                <td>Date de naissance</td>
                <td><input type="date" class="birth_date"></td>
            </tr>
            <tr>
                <td>Mot de passe</td>
                <td><input type="password" class="password"></td>
            </tr>
        </table>
    </form>
    <br>
    <span>Pas encore de compte?</span>
    <a href="signup.php">S'inscrire</a>

    <script src="/static/js/debug.js"></script>
</body>
</html>
