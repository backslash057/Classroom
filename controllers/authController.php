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

        // TODO: validate email and password fields
        $email = $request['email'] ?? '';
        $password = $request['password'] ?? '';

        if(!$email) return ['status' => 'error', 'message' => 'No email specified'];
        if(!$password) return ['status' => 'error', 'message' => 'No password specified'];

        $user = $this->authManager->checkUser($email, $password);

        if ($user) {
            $token = Tokenizer::generateToken($user);

            setcookie("auth_token", $token, [
                "httponly" => true,  // Prevent XSS atack via Javascript
                "secure" => true,    // Send only over HTTPS
                "samesite" => "Strict", // Prevent CSRF attacks
                "expires" => time() + (60 * 60 * 24 * 30)
            ]);
    
            return ['status' => 'success'];
        }
        
        return ['status' => 'error', 'message' => 'Email or password is incorrect'];
    }

    public function signup() {
        $request = json_decode(file_get_contents('php://input'), true);

        // TODO: validate email and password fields
        $email = $request['email'] ?? '';
        $password = $request['password'] ?? '';

        if ($this->authManager->getUserByEmail($email)) {
            return ['status' => 'error', 'message' => 'A user with that email address already exists'];
        }

        $userId = $this->authManager->createUser($email, $password);
        if ($userId) {
            $token = Tokenizer::generateToken($userId);

            setcookie("auth_token", $token, [
                "httponly" => true,  // Prevent XSS atack via Javascript
                "secure" => true,    // Send only over HTTPS
                "samesite" => "Strict", // Prevent CSRF attacks
                "expires" => time() + (60 * 60 * 24 * 30)
            ]);
    
            return ['status' => 'success'];
        }
        return ['status' => 'error', 'message' => 'Signup failed'];
    }

    public function logout() {
        
    }
}
