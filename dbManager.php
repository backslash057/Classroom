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

        // TODO: export database credentials to a more secure way
        $db = new mysqli("localhost", "root", "", "classroom");

        if ($db->connect_error) {
            error_log("Connection failed: " . $db->connect_error);
            return -1;
        }

        $stmt = $db->prepare("INSERT INTO ClassroomUser (names, surnames, email, birth_date, gender, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $names, $surnames, $email, $birth_date, $gender, $password);

        if(!$stmt->execute()) {
            error_log($stmt->error);
            return -1;
        }
        $stmt->close();

        $insertion_id = $db->insert_id;

        $db->close();

        return $insertion_id;
    }
}


?>