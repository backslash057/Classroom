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

    $email = filter_var(trim($data["email"]), FILTER_VALIDATE_EMAIL);
    $password = isset($data["pwd"])? $data["pwd"] : "";

    if(!$email) {
        http_response_code(400); // HTTP 400: Bad request
        echo json_encode(["error" => "Invalid email adress"]);
        exit;
    }

    try {
        $user_id = dbManager::check_user(
            $email, $password
        );

        error_log($user_id);

        if($user_id == null) {
            http_response_code(404); // HTTP 404: Not found
            echo json_encode([
                "error" => "Adresse email ou mot de passe incorrect"
            ]);
        }
        else {
            $token = generateToken([
                "user_id" => $user_id,
    
                // TODO: change the expiration limit and load from a global config
                "expires" => time() +(60 * 60 * 24 * 30)
            ]);
    
            setcookie("auth_token", $token, [
                "httponly" => true,  // Prevent XSS atack via Javascript
                "secure" => true,    // Send only over HTTPS
                "samesite" => "Strict", // Prevent CSRF attacks
                "expires" => time() + (60 * 60 * 24 * 30)
            ]);
            
            http_response_code(202); // HTTP 202: Accepted
            echo json_encode([
                "success" => "Connexion reussie"
            ]);
        }
    }catch(mysqli_sql_exeption $e) {
        error_log("SQL error: " . $e);

        http_response_code(500); // HTTP 500: Internal server error
        echo json_encode([
            "error" => "Une erreur est survenue. Veuillez reessayer"
        ]);
        
    }
}
else {
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
    <form action="/login.php" method="POST" class="form">
        <table style="border: 1px solid black">
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" class="email" required></td>
            </tr>
            <tr>
                <!-- TODO: add a button to reveal the password -->
                <td>Mot de passe</td>
                <td><input type="password" name="pwd" class="password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="submit" value="Se connecter"></td>
            </tr>
        </table>
    </form>
    <br>
    <span>Pas encore de compte?</span>
    <a href="signup.php">S'inscrire</a>

    <!-- <script src="/static/js/debug.js"></script> -->
    <script src="/static/js/login.js"></script>
</body>
</html>

<?php
}
?>

