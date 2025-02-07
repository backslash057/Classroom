<?php

require_once "auth.php";
require_once "dbManager.php";


// Try, load and verify the user datas from his cookies
$user = try_authentification();

// Redirect the user to logout if he is already connected
if($user != null) {
    header("Location: /logout.php");
    exit();
}


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if(!$data) {
        http_response_code(400); // HTTP 400: Bad request
        echo json_encode(["error" => "Invalid data format. JSON expected"]);
        exit;
    }

    // TODO: missing data is not handled (for optional  datas)
    $names = filter_var(trim($data["names"]), FILTER_SANITIZE_STRING);
    $surnames = isset($data["surnames"]) ? filter_var(trim($data["surnames"]), FILTER_SANITIZE_STRING) : null;
    $email = filter_var(trim($data["email"]), FILTER_VALIDATE_EMAIL);
    $birth_date = isset($data["birth_date"]) ? filter_var($data["birth_date"], FILTER_SANITIZE_STRING) : null;
    $gender = isset($data["gender"]) ? filter_var($data["gender"], FILTER_SANITIZE_STRING) : null;
    $password = password_hash($data["pwd"], PASSWORD_BCRYPT);


    if(!$email) {
        http_response_code(400); // HTTP 400: Bad request
        echo json_encode(["error" => "Invalid email address"]);
        exit;
    }


    try {
        $insert_id = DbManager::save_user(
            $names, $surnames,
            $email, $birth_date,
            $gender, $password
        );

        $token = generateToken([
            "user_id" => $insert_id,

            // TODO: change the expiration limit and load from a global config
            "expires" => time() +(60 * 60 * 24 * 30)
        ]);

        setcookie("auth_token", $token, [
            "httponly" => true,  // Prevent XSS atack via Javascript
            "secure" => true,    // Send only over HTTPS
            "samesite" => "Strict", // Prevent CSRF attacks
            "expires" => time() + (60 * 60 * 24 * 30)
        ]);
        
        http_response_code(201); // HTTP 201: Created
        echo json_encode([
            "success" => "Authentification reussie"
        ]);

    } catch(mysqli_sql_exeption $e) {
        error_log("SQL error: " . $e);

        if($e->getCode() == 1062) { // Mysqli duplicate entry error
            http_response_code(409); // HTTP 409: Conflict
            echo json_encode([
                "error" => "Un compte existe deja avec cette adresse email"
            ]);
        }
        else {
            http_response_code(500); // HTTP 500: Internal server error
            echo json_encode([
                "error" => "Une erreur est survenue. Veuillez reessayer"
            ]);
        }
    }

}
else if($_SERVER["REQUEST_METHOD"] == "GET") {
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
                    <sele
                        <option value="M">Homme</option>
                        <option value="F">Femme</option>
                    </select>
                </td>
            </tr>
            <tr>
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

<?php
}
?>