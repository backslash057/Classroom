<?php


// this file is used to test if the built-in token expiracy is working

// 20 seconds after loading this page, the user will be disconnected from the website

require_once "auth.php";


$payload = decodeToken($_COOKIE["auth_token"]);

if($payload != null) {
	echo "Token expires in: " . $payload["expires"] - time();

	$token = generatetoken([
		"user_id" => $payload["user_id"],
		"expires" => time() + 20
	]);
}
else {
	echo "Not authentified";
}


// setcookie("auth_token", $token);

?>