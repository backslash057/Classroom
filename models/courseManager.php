<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

class CourseManager {
    protected $db;

    public function __construct() {
        try {
            $host = "localhost";
            $dbname = "classroom";
            $username = "root";
            $password = "";
            
            $this->db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getAllCourses() {
        try {
            $stmt = $this->db->prepare('SELECT * FROM Course ORDER BY creation_date DESC');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getCourse($course_id) {
        try {
            $stmt = $this->db->prepare('SELECT * FROM Course WHERE id = ?');
            $stmt->execute([$course_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

    public function addCourse($code, $title, $description) {
        try {
            $stmt = $this->db->prepare('INSERT INTO Course (code, title, description) VALUES (?, ?, ?)');
            return $stmt->execute([$code, $title, $description]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateCourse($id, $code, $title, $description) {
        try {
            $stmt = $this->db->prepare('UPDATE Course SET code = ?, title = ?, description = ? WHERE id = ?');
            return $stmt->execute([$code, $title, $description, $id]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteCourse($course_id) {
        try {
            $stmt = $this->db->prepare('DELETE FROM Course WHERE id = ?');
            return $stmt->execute([$course_id]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function joinCourse($user_id, $course_id) {
        try {
            $stmt = $this->db->prepare('INSERT INTO Course_join(user_id, course_id) VALUES (?, ?)');
            return $stmt->execute([$user_id, $course_id]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getJoinedCourses($user_id) {
        try {
            $stmt = $this->db->prepare('
                SELECT * FROM Course
                JOIN Course_join ON Course.id = Course_join.course_id
                WHERE Course_join.user_id = ?
                ORDER BY creation_date DESC
            ');
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }
}
?>
