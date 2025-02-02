<?php
class DbManager {
    public static function save_user($names, $surnames, $email, $birth_date, $password){
        // error_log("Saving user: ");
        // error_log($names);
        // error_log($surnames);
        // error_log($email);
        // error_log($birth_date);
        // error_log($password);

        // TODO: export database credentials to a more secure way
        $mysqli = new mysqli("localhost", "root", "", "classroom");

        if ($mysqli->connect_error) {
            error_log("Connection failed: " . $mysqli->connect_error);
            return 0;
        }

        $stmt = $mysqli->prepare("INSERT INTO users (names, surnames, email, birth_date, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $names, $surnames, $email, $birth_date, $password);

        if(!$stmt->execute()) {
            error_log($stmt->error);
            return 0;
        }

        $stmt->close();
        $mysqli->close();

        return 1;
    }
}


?>