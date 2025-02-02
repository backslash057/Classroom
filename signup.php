<?php
require "dbManager.php";
require "auth.php";

/*
Check if the user is already connected. If so
Redirect to home page
else
display the current page
*/


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if(!$data) {
        http_response_code(400); // HTTP 400: Bad request
        echo json_encode(["error" => "Invalid data format. JSON expected"]);
        exit;
    }

    $names = filter_var(trim($data["names"]), FILTER_SANITIZE_STRING);
    $surnames = isset($data["surnames"]) ? filter_var(trim($data["surnames"]), FILTER_SANITIZE_STRING) : null;
    $email = filter_var(trim($data["email"]), FILTER_VALIDATE_EMAIL);
    $birth_date = isset($data["birth_date"]) ? filter_var($data["birth_date"], FILTER_SANITIZE_STRING) : null;
    $password = password_hash($data["pwd"], PASSWORD_BCRYPT);


    if(!$email) {
        http_response_code(400); // HTTP 400: Bad request
        echo json_encode(["error" => "Invalid email adress"]);
        exit;
    }

    $success = DbManager::save_user(
        $names, $surnames,
        $email, $birth_date,
        $password
    );
    
    if(!$success) {
        http_response_code(500); // HTTP 500: Internal server error
        echo json_encode([
            "error" => "Erreur de sauvegarde des données. Reessayez plus tard"
        ]);
    }
    else {
        // TODO: generate JWT token

        // setcookie("token", $token, [
        //     "httponly" => true,  // Prevent XSS atack via Javascript
        //     "secure" => true,    // Send only over HTTPS
        //     "samesite" => "Strict" // Prevent CSRF attacks
        // ]);
        
        http_response_code(201); // HTTP 201: Created
        echo json_encode([
            "success" => "User was created"
        ]);
    }


}
else if($_SERVER["REQUEST_METHOD"] == "GET") {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Inscription</h1>

    <div class="error_frame"></div>   <!-- dinamically display thge error here -->

    <form action="/signup.php" method="POST" class="form">
        <table>
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
    <span>Pas encore de compte?</span>
    <a href="signup.php">S'inscrire</a>

    <script src="/static/js/debug.js"></script>
    <script src="/static/js/signup.js"></script>
</body>
</html>

<?php
}
?>