<?php
session_start();
header('Content-Type: application/json');

$client_id = "65165833933-jjeav817ef93q86r53i27e3ft6mgc8ms.apps.googleusercontent.com";
$id_token = $_POST['credential'] ?? null;

if(!$id_token){
    echo json_encode(["error"=>"No token provided"]);
    exit;
}

// Use tokeninfo API to avoid cURL issues
$response = @file_get_contents("https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token);
if(!$response){
    echo json_encode(["error"=>"Unable to verify token"]);
    exit;
}

$payload = json_decode($response, true);

if(isset($payload['aud']) && $payload['aud'] === $client_id){
 $picture = isset($payload['picture']) && !empty($payload['picture'])
           ? $payload['picture']
           : '/default_image.gif';

    $_SESSION['user'] = [
        "name" => $payload['name'] ?? 'Unknown',
        "email" => $payload['email'] ?? '',
        "picture" => $picture
    ];

    echo json_encode(["status"=>"success","user"=>$_SESSION['user']]);
}else{
    echo json_encode(["error"=>"Invalid token"]);
}
