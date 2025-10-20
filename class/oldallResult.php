<?php

class allResult{

    private $dbConn;
    private $table_name="leaderboard";

    public function __construct($databaseConnection){
        $this->dbConn= $databaseConnection;
    }


    // fetch all data

    public function getAll(){
        $selectSql="select * from ". $this->table_name . " where category='10' order by wpm desc limit 30";
        $stmt=$this->dbConn->prepare($selectSql);

        if($stmt-> execute()){
            $result= $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }

 
    public function getResultByEmail($email){
        $selectSql="select * from ". $this->table_name . " where email='$email' and category='10'";
        $stmt=$this->dbConn->prepare($selectSql);

        if($stmt-> execute()){
            $result= $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }


    public function getCombinedResults($email, $cat) {
    $combinedData = [];

   
    $emailSql = "SELECT * FROM " . $this->table_name . " WHERE email = ? and category=?";
    $emailStmt = $this->dbConn->prepare($emailSql);
    $emailStmt->bind_param("s", $email);
    $emailStmt->bind_param("s", $cat);

    if ($emailStmt->execute()) {
        $emailResult = $emailStmt->get_result();
        $emailData = $emailResult->fetch_all(MYSQLI_ASSOC);
        $combinedData = array_merge($combinedData, $emailData);
    }

    
    $topSql = "SELECT * FROM " . $this->table_name . " ORDER BY wpm DESC LIMIT 30";
    $topStmt = $this->dbConn->prepare($topSql);

    if ($topStmt->execute()) {
        $topResult = $topStmt->get_result();
        $topData = $topResult->fetch_all(MYSQLI_ASSOC);

        $filteredTopData = array_filter($topData, function($row) use ($emailData) {
            return empty($emailData) || $row['email'] !== $emailData[0]['email'];
        });

        $combinedData = array_merge($combinedData, array_values($filteredTopData));
    }

    return $combinedData;
}



 public function getPosition($email , $cat){
    $selectSql = "
        SELECT COUNT(*) + 1 AS position 
        FROM leaderboard 
        WHERE category= ? and wpm > (
            SELECT wpm FROM leaderboard WHERE email = ?
        )
    ";

    $stmt = $this->dbConn->prepare($selectSql);
    $stmt->bind_param("s", $cat);
    $stmt->bind_param("s", $email);

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