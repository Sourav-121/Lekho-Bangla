<?php
require_once '../config/dbConfig.php';
require_once '../class/allResult.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

try {
    $dbObj = new Database();
    $databaseConnection = $dbObj->getConnection();

    $projectObj = new allResult($databaseConnection);

    if(isset($_POST['email']) && isset($_POST['category'])){
        $email = $_POST['email'];
        $cat = $_POST['category'];
        $out = $projectObj->getCombinedResults($email, $cat);

        if($out){
            echo json_encode($out);
        } else {
            echo json_encode(["message" => "data not found"]);
        }
    } else {
        echo json_encode(["message" => "email and category are required"]);
    }
} catch (Exception $e) {
    error_log("Error in allData.php: " . $e->getMessage());
    echo json_encode(["error" => "Internal server error"]);
}
?>