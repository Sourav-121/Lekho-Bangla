<?php

class allResult{

    private $dbConn;
    private $table_name="leaderboard";

    public function __construct($databaseConnection){
        $this->dbConn= $databaseConnection;
    }

    // public function getCombinedResults($email, $cat) {
    //     $combinedData = [];

        
    //     $emailSql = "SELECT * FROM " . $this->table_name . " WHERE email = ? AND category = ?";
    //     $emailStmt = $this->dbConn->prepare($emailSql);
    //     $emailStmt->bind_param("ss", $email, $cat);

    //     if ($emailStmt->execute()) {
    //         $emailResult = $emailStmt->get_result();
    //         $emailData = $emailResult->fetch_all(MYSQLI_ASSOC);
    //         $combinedData = array_merge($combinedData, $emailData);
    //     }

     
    //     $topSql = "SELECT * FROM " . $this->table_name . " WHERE category = ? ORDER BY wpm DESC LIMIT 30";
    //     $topStmt = $this->dbConn->prepare($topSql);
    //     $topStmt->bind_param("s", $cat); 

    //     if ($topStmt->execute()) {
    //         $topResult = $topStmt->get_result();
    //         $topData = $topResult->fetch_all(MYSQLI_ASSOC);

           
    //         $filteredTopData = array_filter($topData, function($row) use ($email) {
    //             return $row['email'] !== $email;
    //         });

    //         $combinedData = array_merge($combinedData, array_values($filteredTopData));
    //     }

    //     return $combinedData;
    // }



public function getCombinedResults($email, $cat) {
    // Use UNION to get user's data and top data without duplicates
    $sql = "(SELECT * FROM " . $this->table_name . " 
             WHERE email = ? AND category = ?)
            UNION
            (SELECT * FROM " . $this->table_name . " 
             WHERE category = ? AND email != ? 
             ORDER BY wpm DESC LIMIT 29)
            ORDER BY wpm DESC LIMIT 30";
    
    $stmt = $this->dbConn->prepare($sql);
    $stmt->bind_param("ssss", $email, $cat, $cat, $email);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}



    // public function getPosition($email, $cat) {
    //     $selectSql = "
    //         SELECT COUNT(*) + 1 AS position 
    //         FROM leaderboard 
    //         WHERE category = ? AND wpm > (
    //             SELECT wpm FROM leaderboard WHERE email = ? AND category = ?
    //         )
    //     ";

    //     $stmt = $this->dbConn->prepare($selectSql);
    //     $stmt->bind_param("sss", $cat, $email, $cat); 

    //     if ($stmt->execute()) {
    //         $result = $stmt->get_result();
    //         $row = $result->fetch_assoc();
    //         return ["position" => $row['position']];
    //     } else {
    //         return false;
    //     }
    // }


public function getPosition($email, $cat) {
    // First check if user has data for this category
    $checkSql = "SELECT COUNT(*) as count FROM " . $this->table_name . " WHERE email = ? AND category = ?";
    $checkStmt = $this->dbConn->prepare($checkSql);
    $checkStmt->bind_param("ss", $email, $cat);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $checkRow = $checkResult->fetch_assoc();
    
    if ($checkRow['count'] == 0) {
        // User doesn't have data for this category
        return ["position" => "N/A"];
    }
    
    $selectSql = "
        SELECT COUNT(*) + 1 AS position 
        FROM leaderboard 
        WHERE category = ? AND wpm > (
            SELECT wpm FROM leaderboard WHERE email = ? AND category = ?
        )
    ";

    $stmt = $this->dbConn->prepare($selectSql);
    $stmt->bind_param("sss", $cat, $email, $cat);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return ["position" => $row['position']];
    } else {
        return false;
    }
}


}
?>