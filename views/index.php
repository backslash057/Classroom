<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/controllers/authController.php";


$controller = new Authcontroller();
$userData = $controller->checkAuthentification();

if(!$userData || !isset($userData["role"])) {
    require_once $_SERVER["DOCUMENT_ROOT"] . "/views/home/default.php";
}
else if($userData["role"] == "STUDENT") {
    require_once $_SERVER["DOCUMENT_ROOT"] . "/views/home/student_dashboard.php";
}
else if($userData["role"] == "TEACHER") {
    require_once $_SERVER["DOCUMENT_ROOT"] . "/views/home/teacher_dashboard.php";
}
else if($userData["role"] == "ADMIN") {
    require_once $_SERVER["DOCUMENT_ROOT"] . "/views/home/admin_dashboard.php";
}

?>
