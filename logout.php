<?php

if(!isset($_COOKIE["auth_token"])) {
    header("Location: /login.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

}
else if($_SERVER["REQUEST_METHOD"] == "GET") {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deconnexion - Classroom</title>
</head>
<body>
    <div class="output"></div>
    <button class="button">Me deconnecter</button>
    
    <script>
        button = document.querySelector("#button");
        output = document.querySelector(".output");
        button.addEventListener("click", event => logout());

        function logout() {
            fetch("/logout.php",
                {
                    headers: {"Content-Type" : 'application/json'},
                    method: "POST"
                }
            ).then(response => response.json()
            ).then((data) => {
                if(data.success) {
                    button.remove();
                    output.setInnerText(data.succes)
                }
                else if(data.error) display_result(data.error, false);
            })
            .catch(e => {
                display_result("An error occured. Try again later", false);
            });
        }

        //     setcookie("auth_token", "", [
        //         "expires" => time() - 3600,
        //         "path" => "/",
        //         "secure" => true,   // Match the original secure flag
        //         "httponly" => true, // Prevent JavaScript access
        //         "samesite" => "Strict"
        //     ]);

        
    </script>
</body>
</html>
    
<?php
}
?>