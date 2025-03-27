<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

class CourseManager {
    protected $db;

    public function __construct() {
        $host = "localhost";
        $dbname = "classroom";
        $username = "root";
        $password = "";

        $this->db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllCourses() {
        $stmt = $this->db->prepare('SELECT * FROM Course ORDER BY creation_date DESC');
        $stmt->execute([]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourse($course_id) {
        $stmt = $this->db->prepare('SELECT * FROM Course WHERE id = ?');
        $stmt->execute([$course_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addCourse($code, $title, $description) {
        $stmt = $this->db->prepare('INSERT INTO Course (code, title, description) VALUES (?, ?, ?)');

        return $stmt->execute([$code, $title, $description]);
    }

    // public function updateTask($id, $status, $userId) {
    //     $stmt = $this->db->prepare('UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?');

    //     return $stmt->execute([$status, $id, $userId]);
    // }

    public function deleteCourse($course_id) {
        $stmt = $this->db->prepare('DELETE FROM Course WHERE id = ?');

        return $stmt->execute([$id]);
    }
}
?>
