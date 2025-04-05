<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Classroom</title>

    <style><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/css/fonts.css"; ?></style>
    <style><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/css/menu.css"; ?></style>
    <style><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/css/admin.css"; ?></style>
    <style><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/css/courses.css"; ?></style>
</head>
<body>

<div class="menu">
    <div class="logo">
        <img src="imgs/logo.png" alt="Logo">
    </div>
    <ul class="menu-items">
        <li class="active-menu">
            <a href="/">
                <div class="menu-icon"><?php include $_SERVER["DOCUMENT_ROOT"] . "/public/imgs/home.svg"; ?></div>
                <span>Courses</span>
            </a>
        </li>
    </ul>
</div>

<div class="content">
    <div class="head">
        <div class="profile">
            <div class="profile-logo">
                <img src="imgs/profile.jpg" alt="Profile photo">
            </div>
            <div class="user-data">
                <div class="names"><?php echo $userData["names"]; ?></div>
                <div class="role">Teacher</div>
            </div>
            <div class="dropdown">
                <img src="imgs/dropdown.png" alt="Dropdown">
            </div>
        </div>
        <div class="profile-menu">
            <img src="imgs/logout.png" alt="Logout Icon">
            <a href="/logout">Logout</a>
        </div>
    </div>

    <div class="courses-section">
        <button id="add-course-btn" class="add-course-btn">Add Course</button>
        <div id="courses-list"></div>
    </div>

    
    <div id="add-course-modal" class="modal">
        <div class="modal-content">
            <h2>Add a New Course</h2>
            <input type="text" id="course-code" placeholder="Course Code">
            <input type="text" id="course-title" placeholder="Course Title">
            <textarea id="course-description" placeholder="Course Description"></textarea>
            <div class="modal-actions">
                <button id="submit-course" class="btn">Create</button>
                <button id="close-modal" class="btn cancel">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="js/courses.js"></script>

</body>
</html>
