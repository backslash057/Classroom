<?php


// Route management for '/students'

require_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/authController.php";

$controller = new Authcontroller();
$userData = $controller->checkAuthentification();

if($userData && isset($userData["role"]) && $userData["role"] == "ADMIN") {
    require_once $_SERVER["DOCUMENT_ROOT"] . "/views/admin/students_page.php";
}
else {
    require_once $_SERVER["DOCUMENT_ROOT"] . "/views/404.html";
}

?>
