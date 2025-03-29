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
        </ul>
    </div>
    <div class="body">
        <div class="head"></div>

        Student dashboard
        <a href="/logout">Log out</a>

        <br>
        <br>
        <h3>Your courses</h3>
    </div>

</body>
</html>