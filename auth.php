<?php

require 'config.php';


function base64_url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64_url_decode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}


function generateToken($payload) {
    global $secret_key;
    $header = json_encode(["alg" => "HS256", "typ" => "JWT"]);
    $headerEncoded = base64_url_encode($header);
    $payloadEncoded = base64_url_encode(json_encode($payload));

    $signature = hash_hmac('sha256', $headerEncoded . '.' . $payloadEncoded, $secret_key, true);
    $signatureEncoded = base64_url_encode($signature);

    return $headerEncoded . '.' . $payloadEncoded . '.' . $signatureEncoded;
}

function decodeToken($token) {
    global $secret_key;
    list($headerEncoded, $payloadEncoded, $signatureEncoded) = explode('.', $token);

    $header = json_decode(base64_url_decode($headerEncoded), true);
    $payload = json_decode(base64_url_decode($payloadEncoded), true);

    $signature = base64_url_decode($signatureEncoded);
    $checkSignature = hash_hmac('sha256', $headerEncoded . '.' . $payloadEncoded, $secret_key, true);

    if ($signature === $checkSignature && $payload["expires"] > time()) {
        return $payload;
    }

    return null;
}

?>
