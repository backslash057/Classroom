<?php

require "auth.php";

$user = isset($_COOKIE["auth_token"])? decodeToken($_COOKIE["auth_token"]): null;


if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($user == null) {
        echo json_encode(["error" => "Vous etes deja deconnecté"]);
        exit;
    }
    
    setcookie("auth_token", "", [
        "expires" => time() - 3600,
        "path" => "/",
        "secure" => true, 
        "httponly" => true,
        "samesite" => "Strict"
    ]);

    echo json_encode(["success" => "Vous etes maintenant deconnecté du site"]);
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
    <?php
        if($user == null) {
            echo "Vous etes deja deconnecté";
            echo "<br>";
            echo "<a href='/'>Home page</a>";
        }
        else {
    ?>
        <div class="output"></div>
        <button class="button">Me deconnecter</button>
        
        <script>
            button = document.querySelector(".button");
            output = document.querySelector(".output");
            button.addEventListener("click", event => logout());


            function logout() {
                fetch("/logout.php", {method: "POST"}
                ).then(response => response.json()
                ).then((data) => {
                    if(data.success) {
                        button.remove();
                        output.innerText = data.success
                    }
                    else if(data.error) {
                        output.innerText = data.error;
                    }
                })
                .catch(e => {
                    output.innerText = "An error occured. Try again later";
                });
            }

            
        </script>
    <?php
        }
    ?>
    </body>
    </html>
<?php
}
?>