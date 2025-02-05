<?php
require "auth.php";

$user = isset($_COOKIE["auth_token"])? decodeToken($_COOKIE["auth_token"]): null;

if($user != null) {
    header("Location: /");
    exit();
}


if($_SERVER["REQUEST_METHOD"] == "POST") {

}
else {
?>
    <!DOCTYPE html>
    <html lang="fr">
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
                    <td><input type="email" class="email"></td>
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

        <!-- <script src="/static/js/debug.js"></script> -->
    </body>
    </html>

<?php
}
?>

