<?php
require "auth.php";

$user = isset($_COOKIE["auth_token"])? decodeToken($_COOKIE["auth_token"]): null;

if($user != null) {
    header("Location: /");
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
    $password = password_hash($data["pwd"], PASSWORD_BCRYPT);

    if(!$email) {
        http_response_code(400); // HTTP 400: Bad request
        echo json_encode(["error" => "Invalid email adress"]);
        exit;
    }

    $user = dbManager::check_user(
        $email, $password
    );

    if($user == null) {
        http_response_code(404); // HTTP 500: Internal server error
        echo json_encode([
            "error" => "Adresse email ou mot de passe incorrect"
        ]);
    }
    else {
        $token = generateToken([
            "user_id" => $user['user_id'],
            "names" => $user["names"],
            "surnames" => $user["surnames"],
            "email" => $user["email"],
            // TODO: change the expiration limit and load from a global config
            "expires" => time() +(60 * 60 * 24 * 30)
        ]);

        setcookie("auth_token", $token, [
            "httponly" => true,  // Prevent XSS atack via Javascript
            "secure" => true,    // Send only over HTTPS
            "samesite" => "Strict" // Prevent CSRF attacks
        ]);
        
        http_response_code(200); // HTTP 200: Ok
        echo json_encode([
            "success" => "Log in succesful"
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

