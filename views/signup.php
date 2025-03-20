<?php


// Try, load and verify the user datas from his cookies
$user = try_authentification();

// Redirect the user to logout if he is already connected
if($user != null) {
    header("Location: /logout.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Classroom</title>
</head>
<body>
    <h1>Inscription</h1>

    <div class="error_frame"></div>   <!-- dinamically display the error here -->

    <form action="/signup.php" method="POST" class="form">
        <table style="border: 1px solid black">
            <tr>
                <td>Noms</td>
                <td><input type="text" name="names" class="names" required></td>
            </tr>
            <tr>
                <td>Prenoms</td>
                <td><input type="text" name="surnames" class="surnames"></td>
            </tr>
            <tr>
                <td>email</td>
                <td><input type="text" name="email" class="email" required></td>
            </tr>
            <tr>
                <td>Date de naissance</td>
                <td><input type="date" name="birth_date" class="birth_date"></td>
            </tr>
            <tr>
                <td>Genre</td>
                <td>
                    <select name="gender">
                        <option value="M">Homme</option>
                        <option value="F">Femme</option>
                    </select>
                </td>
            </tr>
            <tr>
                <!-- TODO: add a button to reveal the password -->
                <td>Mot de passe</td>
                <td><input type="password" name="pwd" class="password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="S'inscrire" class="submit"></td>
            </tr>
        </table>
    </form>
    <br>
    <span>Deja un compte?</span>
    <a href="login.php">Se connecter</a>

    <!-- <script src="/static/js/debug.js"></script> -->
    <script src="/static/js/signup.js"></script>
</body>
</html>
