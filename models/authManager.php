<?php

$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';


class AuthManager {
    protected $db;

    public function __construct() {
        $host = "localhost";
        $dbname = "todo_db";
        $username = "root";
        $password = "";

        $this->db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Creates a new user with a hashed password
    public function createUser($email, $password) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare('INSERT INTO users(email, password) VALUES (?, ?)');
        $stmt->execute([$email, $hashed]);

        return $this->db->lastInsertId();
    }

    // Retrieves user data by email
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verifies credentials; returns user data if valid, false otherwise
    public function checkUser($email, $password) {
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return [
                "email" => $user["email"]
            ];
        }

        return null;
    }
}

?>