<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/authController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/courseManager.php';

class CourseController {
    private $courseManager;
    private $auth;

    public function __construct() {
        $this->auth = new AuthController();
        $this->courseManager = new CourseManager();
    }

    public function handleRequest($method) {
        try {
            $user = $this->auth->checkAuthentification();
            if (!$user || $user["role"] != "ADMIN") {
                return ['success' => false, 'message' => 'Unauthorized'];
            }

            switch ($method) {
                case 'GET':
                    if (isset($_GET['id'])) {
                        $course_id = (int) $_GET['id'];
                        if (!$course_id) return ['success' => false, 'message' => 'Invalid course ID'];
                        
                        $course = $this->courseManager->getCourse($course_id);
                        
                        if ($course) return ['success' => true, 'course' => $course];
                        return ['success' => false, 'message' => 'Course not found'];
                    }
                    return ['success' => true, 'courses' => $this->courseManager->getAllCourses()];
                    
                case 'POST':
                    $data = json_decode(file_get_contents('php://input'), true);
                    if (isset($data['code'], $data['title'], $data['description'])) {
                        if ($this->courseManager->addCourse($data['code'], $data['title'], $data['description'])) {
                            return ['success' => true, 'message' => 'Course created'];
                        }
                        else return ['success' => false, 'message' => "Course with code {$data['code']} already exists"];
                    }
                    return ['success' => false, 'message' => 'Course creation failed'];
                    
                case 'PUT':
                    $data = json_decode(file_get_contents('php://input'), true);
                    if (isset($data['id'], $data['code'], $data['title'], $data['description'])) {
                        if ($this->courseManager->updateCourse($data['id'], $data['code'], $data['title'], $data['description'])) {
                            return ['success' => true, 'message' => 'Course updated'];
                        }
                        else return ['success' => false, 'message' => 'Course not found'];
                    }
                    return ['success' => false, 'message' => 'Course update failed'];
                    
                case 'DELETE':
                    $data = json_decode(file_get_contents('php://input'), true);
                    if (isset($data['id'])) {
                        if ($this->courseManager->deleteCourse($data['id'])) {
                            return ['success' => true, 'message' => 'Course deleted'];
                        }
                        else return ['success' => false, 'message' => 'Course not found'];
                    }
                    return ['success' => false, 'message' => 'Course deletion failed'];
                    
                default:
                    http_response_code(405);
                    return ['success' => false, 'message' => 'Method Not Allowed'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}
?>
