<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin section</title>

    <!-- ne marche pas (pour je ne sait quel raison) -->
    <!-- <link rel="stylesheet" type="text/css" href="/public/css/admin.css">    -->
    
    
    <style><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/css/fonts.css" ?></style>
    <style><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/css/menu.css" ?></style>
    <style><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/css/admin.css" ?></style>
</head>
<body>
    <div class="menu">
        <div class="logo">
            <img src="imgs/logo.png">
        </div>
        <ul class="menu-items">
            <li>
                <a href="/">
                    <div class="menu-icon"><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/imgs/home.svg" ?></div>
                    <span>Home</span>
                </a>
            </li>
            <li class="active-menu">
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
        <div class="head">
            <div class="profile">
                <div class="profile-logo">
                    <img src="imgs/profile.jpg" alt="Administrator profile photo">
                </div>
                <div class="user-data">
                    <div class="names"><?php echo $userData["names"] ?></div>
                    <div class="role">Admin</div>
                </div>
                <div class="dropdown">
                    <img src="imgs/dropdown.png" alt="Dropdown for profile section">
                </div>
            </div>
            <div class="profile-menu">
                <img src="imgs/logout.png" alt="Icon for logout button" srcset="">
                <a href="/logout">Logout</a>
            </div></div>

        List of students
    </div>
</body>
</html>