<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/tokenizer.php';

class AuthController {
    protected $authManager;

    public function __construct() {
        $this->authManager = new AuthManager();
    }

    public function login() {
        $request = json_decode(file_get_contents('php://input'), true);

        // TODO: handle missing/optional datas
        $email = filter_var(trim($data["email"]), FILTER_VALIDATE_EMAIL);
        $password = password_hash($data["pwd"], PASSWORD_BCRYPT);

        if(!$email) return ['success'=>false, 'message' => 'Invalid email address'];

        
        $user = $this->getUserByEmail($email);
        $matches = $user && password_verify($password, $user['password']);
        
        if ($matches){
            $token = Tokenizer::generateToken($email);

            setcookie("auth_token", $token, [
                "httponly" => true,  // Prevent XSS atack via Javascript
                "secure" => true,    // Send only over HTTPS
                "samesite" => "Strict", // Prevent CSRF attacks
                "expires" => time() + (60 * 60 * 24 * 30) // 30 days
            ]);
    
            return ['success'=>true, 'message'=>'Succesfully connected'];
        }
        
        return ['success'=>false, 'message' => 'Email or password is incorrect'];
    }

    public function signup() {
        $request = json_decode(file_get_contents('php://input'), true);
        
        // TODO: handle missing/optional datas
        $names = filter_var(trim($request["names"]), FILTER_SANITIZE_STRING);
        $surnames = isset($request["surnames"]) ? filter_var(trim($request["surnames"]), FILTER_SANITIZE_STRING) : null;
        $email = filter_var(trim($request["email"]), FILTER_VALIDATE_EMAIL);
        $birth_date = isset($request["birth_date"]) ? filter_var($request["birth_date"], FILTER_SANITIZE_STRING) : null;
        $gender = isset($request["gender"]) ? filter_var($request["gender"], FILTER_SANITIZE_STRING) : null;
        $password = password_hash($request["password"], PASSWORD_BCRYPT);

        if(!$email) return ['success'=>false, 'message' => 'Invalid email address'];
        
        if ($this->authManager->getUserByEmail($email)) {
            return ['success'=>true, 'message' => 'A user with that email address already exists'];
        }
        
        $userId = $this->authManager->createUser(
            $names, $surnames, $email, $birth_date, $gender, $password
        );
        
        if ($userId) {
            $token = Tokenizer::generateToken($email);

            setcookie("auth_token", $token, [
                "httponly" => true,  // Prevent XSS atack via Javascript
                "secure" => true,    // Send only over HTTPS
                "samesite" => "Strict", // Prevent CSRF attacks
                "expires" => time() + (60 * 60 * 24 * 30) // 30 days
            ]);
    
            return ['success'=>true, 'message'=>'Sign up succesfull'];
        }
        return ['success'=>false, 'message' => 'Signup failed'];
    }

    public function logout() {
        // TODO: create this for the logout page backend
        setcookie("auth_token", "", [
            "expires" => time() - 3600,
            "path" => "/",
            "secure" => true, 
            "httponly" => true,
            "samesite" => "Strict"
        ]);

        return  ["success" => "Succesfully disconnected"];
    }

    public function checkAuthentification() {
        if(isset($_COOKIE['auth_token'])) {
            $token = $_COOKIE['auth_token'];
            $payload = Tokenizer::decodeToken($token);

            if($payload != null && isset($payload["expires"]) && $payload['expires']>time()) {
                if(isset($payload["email"])) {
                    return $this->authManager->getUserByEmail($payload["email"]);
                }
            }
            else if(isset($payload["expires"]) && $payload['expires']<time()) {
                // logout();
            }
        }

        return null;
    }
}
?>