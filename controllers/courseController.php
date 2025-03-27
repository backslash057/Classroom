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
        $user = $this->auth->checkAuthentification();

        if (!$user || $user["role"] != "ADMIN") {
            return ['success' => false, 'message' => 'Unauthorized'];
        }

        switch ($method) {
            case 'GET':
                if(isset($_GET['id'])) {
                    $course_id = (int) $_GET['id'];
                    if(!$course_id) ['success' => false, 'message' => 'Course not found'];

                    $course =  $this->courseManager->getCourse($course_id);
                    if(!$course) return ['success' => false, 'message'=>'Course not found'];
                }
                else {
                    return [
                        'success' => true,
                        'courses' => $this->courseManager->getAllCourses()
                    ];
                }
                break;

            case 'POST':
                $data = json_decode(file_get_contents('php://input'), true);

                $code = $data["code"];
                $title = $data["title"];
                $desc = $data["description"];

                if ($code && $title && $desc) {
                    if($this->courseManager->addCourse($code, $title, $desc)) {
                        return ['success' => true, 'message' => 'Course created'];
                    }
                    else return ['success' => false, 'message' => 'Course creation failed'];
                }
                else {
                    return ['success' => false, 'message' => 'Course creation failed'];
                }

                break;

            case 'PUT':
                parse_str(file_get_contents('php://input'), $data);
                if (isset($data['id'], $data['status'])) {
                    $this->courseManager->updateTask($data['id'], $data['status'], $userId);
                    return ['success' => true, 'message' => 'Task updated'];
                }
                break;

            case 'DELETE':
                parse_str(file_get_contents('php://input'), $data);
                if (isset($data['id'])) {
                    $this->courseManager->deleteTask($data['id'], $userId);
                    return ['success' => true, 'message' => 'Task deleted'];
                }
                break;

            default:
                http_response_code(405);
                return ['success' => false, 'message' => 'Method Not Allowed'];
                break;
        }
    }
}
?>