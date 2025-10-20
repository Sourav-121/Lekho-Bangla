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
        $name = $resultData['name'];
        $email = $resultData['email'];
        $wpm = (int)$resultData['wpm']; 
        $accuracy = (float)$resultData['accuracy']; 
        $category = $resultData['category'];
        $date = $resultData['date'];
        $time = $resultData['time'];
        
        // First check if email already exists
        $checkSql = "SELECT id, wpm FROM " . $this->table_name . " WHERE email = ?";
        $checkStmt = $this->dbConn->prepare($checkSql);
        
        if (!$checkStmt) {
            error_log("Prepare failed: " . $this->dbConn->error);
            return false;
        }
        
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();
        
        if ($checkStmt->num_rows > 0) {
            // Email exists, check if current WPM is higher
            $checkStmt->bind_result($existingId, $existingWpm);
            $checkStmt->fetch();
            
            if ($wpm > $existingWpm) {
                // New WPM is higher, update the record
                return $this->updateResult($existingId, $name, $wpm, $accuracy, $category, $date, $time);
            } else {
                // New WPM is not higher, do nothing
                return true; // Return true since it's not an error, just no action needed
            }
        } else {
            // Email doesn't exist, insert new record
            return $this->insertNewResult($name, $email, $wpm, $accuracy, $category, $date, $time);
        }
    }
    
    private function insertNewResult($name, $email, $wpm, $accuracy, $category, $date, $time) {
        $sql = "INSERT INTO " . $this->table_name . " (name, email, wpm, accuracy, category, date, time) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->dbConn->prepare($sql);
        
        if (!$stmt) {
            error_log("Prepare failed: " . $this->dbConn->error);
            return false;
        }
        
        $stmt->bind_param("ssidsss", $name, $email, $wpm, $accuracy, $category, $date, $time);
        
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }
        
        return true;
    }
    
    private function updateResult($id, $name, $wpm, $accuracy, $category, $date, $time) {
        $sql = "UPDATE " . $this->table_name . " SET name = ?, wpm = ?, accuracy = ?, category = ?, date = ?, time = ? WHERE id = ?";
        $stmt = $this->dbConn->prepare($sql);
        
        if (!$stmt) {
            error_log("Prepare failed: " . $this->dbConn->error);
            return false;
        }
        
        $stmt->bind_param("sidsssi", $name, $wpm, $accuracy, $category, $date, $time, $id);
        
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }
        
        return true;
    }
}
?>