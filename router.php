<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/courseController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/authController.php';


$requestUri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
if($requestUri == "") $requestUri = "/";

$method = $_SERVER['REQUEST_METHOD'];

error_log($method . " " . $requestUri);

// no matter what is the request method
if($requestUri == "/") { 
    require_once($_SERVER["DOCUMENT_ROOT"] . "/routes/index.php");
}
else if($requestUri == "/courses") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/routes/courses.php");
}
else if($requestUri == "/teachers") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/routes/teachers.php");
}
else if($requestUri == "/students") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/routes/students.php");
}
else if($requestUri == "/finances") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/routes/finances.php");
}
else if($requestUri == "/exams") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/routes/exams.php");
}


// Add some else if for the front end


else if ($requestUri == '/login') {
    if($method == 'POST') {
        // TODO: add a try catch in case operation fails
        $controller = new AuthController();
        $response = $controller->login();

        header("Content-Type: application/json");
        echo json_encode($response);
    }
    else if($method == "GET") {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/views/auth/login.php");
    }
}
else if ($requestUri == '/signup') {
    if($method == 'POST') {
        // TODO: add a try catch in case operation fails
        $controller = new AuthController();
        $response = $controller->signup();

        header("Content-Type: application/json");
        echo json_encode($response);
    }
    else if($method == "GET") {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/views/auth/signup.php";
    }
}
else if($requestUri == "/logout") {
    if($method == "POST") {
        // TODO: add a try catch in case operation fails
        $controller = new AuthController();
        $response = $controller->logout();
        
        header("Content-Type: application/json");
        echo json_encode($response);
    }
    else if($method == "GET"){
        require_once $_SERVER["DOCUMENT_ROOT"] . "/views/auth/logout.php";
    }
}
else if($requestUri == "/api/courses") {
    $controller = new CourseController();
    $response = $controller->handleRequest($method);

    header("Content-Type: application/json");
    echo json_encode($response);
}
else if(false) {

}


// Add some else if for other api calls


else if ($method == "GET" && file_exists($_SERVER["DOCUMENT_ROOT"] . '/public/' . $requestUri)) {
    // Handle static files for the front end
    
    include_once $_SERVER["DOCUMENT_ROOT"] . '/public/' . $requestUri;
}
else {
    // TODO: change and return the 404 page response page instead
    echo json_encode(["success"=>false, 'message' => 'Route not found.']);
}

?>
