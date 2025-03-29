<?php


// Route management for '/teachers'

require_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/authController.php";

$controller = new Authcontroller();
$userData = $controller->checkAuthentification();

if($userData && isset($userData["role"]) && $userData["role"] == "ADMIN") {
    require_once $_SERVER["DOCUMENT_ROOT"] . "/views/admin/teachers_page.php";
}
else {
    require_once $_SERVER["DOCUMENT_ROOT"] . "/views/404.html";
}

?>
