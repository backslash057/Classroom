<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Classroom</title>

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
            <li class="active-menu">
                <a href="/">
                    <div class="menu-icon"><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/imgs/home.svg" ?></div>
                    <span>Home</span>
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
                    <div class="role">Student</div>
                </div>
                <div class="dropdown">
                    <img src="imgs/dropdown.png" alt="Dropdown for profile section">
                </div>
            </div>
            <div class="profile-menu">
                <img src="imgs/logout.png" alt="Icon for logout button" srcset="">
                <a href="/logout">Logout</a>
            </div></div>
            Student dashboard
        <br>
        <br>
        <h3>Your courses</h3>
    </div>

</body>
</html>