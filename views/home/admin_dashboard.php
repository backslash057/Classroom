<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Section</title>

    <!-- ne marche pas (pour je ne sait quel raison) -->
    <!-- <link rel="stylesheet" type="text/css" href="/views/static/css/admin.css">    -->
    
    <style><?php include $_SERVER["DOCUMENT_ROOT"] . "/views/static/css/admin.css" ?></style>
</head>
<body>


    <button id="course-add">Add course</button>
    <table id="course-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>title</th>
                <th>Desciption</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    
    <button id="student-add">Add student</button>
    <table id="student-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Last name</th>
                <th>Inscription date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <button id="teacher-add">Add teacher</button>
    <table id="teacher-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Last name</th>
                <th>Gender</th>
                <th>Birth date</th>
                <th>Phone number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script src="/views/static/js/admin.js"></script>
</body>
</html>
