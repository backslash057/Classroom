<?php

$config = require $_SERVER['DOCUMENT_ROOT'] . '/config.php';


class AuthManager {
    protected $db;

    public function __construct() {
        $host = "localhost";
        $dbname = "classroom";
        $username = "root";
        $password = "";

        $this->db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function createUser($names, $surnames, $email, $birth_date, $gender, $password) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("
            INSERT INTO Users(names, surnames, email, birth_date, gender, password)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $names, $surnames, $email, $birth_date, $gender, $hashed
        ]);

        return $this->db->lastInsertId();
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT names, surnames, email, birth_date, gender FROM Users WHERE email = ?");
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>