<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin section</title>
    
    <style><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/css/fonts.css" ?></style>
    <style><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/css/menu.css" ?></style>
    <style><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/css/admin.css" ?></style>
</head>
<body>
    <div class="menu">
        <div class="logo">
            <div class= "img-container">
                <img src="imgs/logo.png">
            </div>
            <span>Sp!k</span>
        </div>

        <ul class="menu-items">
            <li class="active-menu">
                <a href="/">
                    <div class="menu-icon"><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/imgs/home.svg" ?></div>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="/students">
                    <div class="menu-icon"><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/imgs/student.svg" ?></div>
                    <span>Students</span>
                </a>
            </li>
            <li>
                <a href="/teachers">
                    <div class="menu-icon"><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/imgs/teacher.svg" ?></div>
                    <span>Teachers</span>
                </a>
            </li>
            <li>
                <a href="/courses">
                    <div class="menu-icon"><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/imgs/courses.svg" ?></div>
                    <span>Courses</span>
                </a>
            </li>
            <li>
                <a href="/exams">
                    <div class="menu-icon"><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/imgs/exams.svg" ?></div>
                    <span>Exams</span>
                </a>
            </li>
            <li>
                <a href="/finances">
                    <div class="menu-icon"><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/imgs/finances.svg" ?></div>
                    <span>Finances</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
        <div class="head"></div>

        Dashboard
    </div>
</body>
</html>