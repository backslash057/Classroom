<?php

class DbManager {
    public static function save_user($names, $surnames, $email, $birth_date, $gender, $password){
        // error_log("Saving user: ");
        // error_log($names);
        // error_log($surnames);
        // error_log($email);
        // error_log($birth_date);
        // error_log($gender);
        // error_log($password);

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        // TODO: export database credentials to a more secure way
        $db = new mysqli("localhost", "root", "", "classroom");

        $stmt = $db->prepare("INSERT INTO ClassroomUser (names, surnames, email, birth_date, gender, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $names, $surnames, $email, $birth_date, $gender, $password);
        
        $stmt->execute();
        
        $stmt->close();
        $insertion_id = $db->insert_id;
        $db->close();

        return $insertion_id;
    }

    public static function check_user($email, $password) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $db = new mysqli("localhost", "root", "", "classroom");

        $stmt = $db->prepare("SELECT user_id, password FROM ClassroomUser WHERE email=?");
        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        $stmt->close();
        $db->close();

        if ($user && password_verify($password, $user['password'])) {
            return $user['user_id'];
        }

        return null;
    }

    public static function find_user($user_id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $db = new mysqli("localhost", "root", "", "classroom");

        $stmt = $db->prepare("
            SELECT email, names, surnames, gender, birth_date
            FROM ClassroomUser
            WHERE user_id=?
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $stmt->close();
        $db->close();

        return $user;
    }
}


?>