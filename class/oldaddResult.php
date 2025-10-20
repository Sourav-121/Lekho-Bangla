<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class addResult{

    private $dbConn;
    private $table_name="leaderboard";

    public function __construct(mysqli $databaseConnection){
        $this->dbConn= $databaseConnection;
    }
   

public function insertResult($resultData){

    $Sql = "insert into " . $this->table_name . " (name, email, wpm, accuracy, category, date, time) values (?,?,?,?,?,?,?)";
    $stmt = $this->dbConn->prepare($Sql);
    
    if (!$stmt) {
    error_log("Prepare failed: " . $this->dbConn->error);
    return false;
}

        
//    $stmt->bind_param("ssidsss",
        
//         $resultData['name'],
//         $resultData['email'],
//         $resultData['wpm'],
//         $resultData['accuracy'],
//         $resultData['category'],
//         $resultData['date'],
//         $resultData['time']
//     );

    

// if (! $stmt->execute()) {
//     error_log("Execute failed:  " . $stmt->error);
//     return false;
// }

//     return true;





    $name = $resultData['name'];
    $email = $resultData['email'];
    $wpm = (int)$resultData['wpm']; 
    $accuracy = (float)$resultData['accuracy']; 
    $category = $resultData['category'];
    $date = $resultData['date'];
    $time = $resultData['time'];
    
    $stmt->bind_param("ssidsss", $name, $email, $wpm, $accuracy, $category, $date, $time);

    if (!$stmt->execute()) {
        error_log("Execute failed: " . $stmt->error);
        return false;
    }

    return true;


}


}

?>