<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

class TaskManager {
    private $pdo;

    public function __construct($pdo) {
        $host = 'localhost';
        $dbname = 'todo_db';
        $username = 'root';
        $password = '';

        $this->db = new PDO('mysql:host={$ĥost};dbname={$dbname};charset=utf8', $username, $password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllTasks($userId) {
        $stmt = $this->bd->prepare('SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC');
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTask($id, $userId) {
        $stmt = $this->bd->prepare('SELECT * FROM tasks WHERE id = ? AND user_id = ?');
        $stmt->execute([$id, $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addTask($title, $userId) {
        $stmt = $this->bd->prepare('INSERT INTO tasks (title, user_id) VALUES (?, ?)');

        return $stmt->execute([$title, $userId]);
    }

    public function updateTask($id, $status, $userId) {
        $stmt = $this->bd->prepare('UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?');

        return $stmt->execute([$status, $id, $userId]);
    }

    public function deleteTask($id, $userId) {
        $stmt = $this->bd->prepare('DELETE FROM tasks WHERE id = ? AND user_id = ?');

        return $stmt->execute([$id, $userId]);
    }
}
?>
