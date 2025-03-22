<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/taskController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/authController.php';


$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if($requestUri == "/") {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/views/index.php");
}
else if ($requestUri == '/login') {
    if($method == 'POST') {
        // TODO: add a try catch in case operation fails
        $controller = new AuthController();
        $response = $controller->login();

        header("Content-Type: application/json");
        echo json_encode($response);
    }
    else if($method == "GET") {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/views/login.php");
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
        require_once $_SERVER['DOCUMENT_ROOT'] . "/views/signup.php";
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
        require_once $_SERVER["DOCUMENT_ROOT"] . "/views/logout.php";
    }
}
else if(file_exists($_SERVER["DOCUMENT_ROOT"] . $requestUri)) {
    require_once($_SERVER["DOCUMENT_ROOT"] . $requestUri);
}
else if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/" . $requestUri)) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/". $requestUri);
}
// else if (preg_match('^\/tasks(\/\d+)?$', $requestUri, $matches)) {
//     $controller = new TaskController();
//     $controller->handleRequest();
// }
else {
    // TODO: change and return the 404 page response page instead
    echo json_encode(["success"=>false, 'message' => 'Route not found.']);
}

?>
