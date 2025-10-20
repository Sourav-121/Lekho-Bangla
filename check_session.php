<?php
session_start();
header('Content-Type: application/json');

if(isset($_SESSION['user'])){
    $response = [
        'status' => 'logged_in',
        'user' => [
            'name' => $_SESSION['user']['name'],
            'email' => $_SESSION['user']['email'],
            'picture' => 'image_proxy.php' 
        ]
    ];
    echo json_encode($response);
} else {
    echo json_encode(["status"=>"logged_out"]);
}
?>