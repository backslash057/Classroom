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
            if (!$user || ($user["role"] == "STUDENT" && $method != "GET" && $method != "POST")) {
                http_response_code(403);
                return ['success' => false, 'message' => 'Unauthorized'];
            }

            // Always parse JSON input (even for GET)
            $data = json_decode(file_get_contents('php://input'), true) ?? [];

            switch ($method) {
                case 'GET':
                    if(isset($_GET['joined']) && $_GET['joined']==1) {
                        $user_id = $user["user_id"];
                        $courses = $this->courseManager->getJoinedCourses($user_id);
                        error_log(print_r($courses, true));
                        return ['success' => true, 'courses' => $courses];
                    }
                    else {
                        if (!empty($data['id'])) {
                            $course_id = (int) $data['id'];
                            if ($course_id <= 0) {
                                http_response_code(400);
                                return ['success' => false, 'message' => 'Invalid course ID'];
                            }

                            $course = $this->courseManager->getCourse($course_id);
                            if ($course) {
                                return ['success' => true, 'course' => $course];
                            } else {
                                http_response_code(404);
                                return ['success' => false, 'message' => 'Course not found'];
                            }
                        } else {
                            $courses = $this->courseManager->getAllCourses();
                            return ['success' => true, 'courses' => $courses];
                        }
                    }

                case 'POST':
                    if($user['role']=="STUDENT") {
                        if ($this->courseManager->joinCourse($user['user_id'], $data['course_id'])) {
                            http_response_code(201);
                            return ['success' => true, 'message' => 'Course joined successfully'];
                        }

                        http_response_code(400);
                        return ['success' => false, 'message' => 'Course join failed'];
                    }
                    else {
                        if (isset($data['code'], $data['title'], $data['description'])) {
                            if ($this->courseManager->addCourse($data['code'], $data['title'], $data['description'])) {
                                http_response_code(201);
                                return ['success' => true, 'message' => 'Course created'];
                            } else {
                                http_response_code(409);
                                return ['success' => false, 'message' => "Course with code {$data['code']} already exists"];
                            }
                        }
                        http_response_code(400);
                        return ['success' => false, 'message' => 'Missing fields for course creation'];
                    }

                case 'PUT':
                    if (isset($data['id'], $data['code'], $data['title'], $data['description'])) {
                        if ($this->courseManager->updateCourse($data['id'], $data['code'], $data['title'], $data['description'])) {
                            return ['success' => true, 'message' => 'Course updated'];
                        } else {
                            http_response_code(404);
                            return ['success' => false, 'message' => 'Course not found'];
                        }
                    }
                    http_response_code(400);
                    return ['success' => false, 'message' => 'Missing fields for course update'];

                case 'DELETE':
                    if (isset($data['id'])) {
                        if ($this->courseManager->deleteCourse($data['id'])) {
                            return ['success' => true, 'message' => 'Course deleted'];
                        } else {
                            http_response_code(404);
                            return ['success' => false, 'message' => 'Course not found'];
                        }
                    }
                    http_response_code(400);
                    return ['success' => false, 'message' => 'Missing course ID for deletion'];

                default:
                    http_response_code(405);
                    return ['success' => false, 'message' => 'Method Not Allowed'];
            }
        } catch (Exception $e) {
            http_response_code(500);
            return ['success' => false, 'message' => 'Server Error: ' . $e->getMessage()];
        }
    }
}
?>
