<?php
require_once '../config/dbConfig.php';
require_once '../class/addResult.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


$dbObj = new Database();
$databaseConnection = $dbObj->getConnection();

$projectObj = new addResult($databaseConnection);


if(isset($_POST['resultData'])){
      $json = $_POST['resultData'];
 $eventData = json_decode($json, true);

  
    $result = $projectObj->insertResult($eventData);

    if($result){
        echo json_encode(["status" => "success", "message" => "LeaderBoard Updated Successfully !!!"]);
    } else {
        echo json_encode(["status" => "failed", "message" => " Failed to add !!!"]);
    }
} else {
    echo json_encode(["status" => "failed","message" => "Missing required fields"]);
}