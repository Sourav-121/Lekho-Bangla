<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class addEvent{

    private $dbConn;
    private $table_name="event";

    public function __construct($databaseConnection){
        $this->dbConn= $databaseConnection;
    }
   

public function insertEvent($eventData){

    $Sql = "insert into " . $this->table_name . " (event_title , event_description, registration_date, link , created_by) values (?,?,?,?,?)";
    $stmt = $this->dbConn->prepare($Sql);
    
    if(!$stmt) return false;
        
   $stmt->bind_param("ssssi",
        $eventData['event_title'],
        $eventData['event_description'],
        $eventData['registration_date'],
        $eventData['link'],
        $eventData['created_by']
    );

    

if (! $stmt->execute()) {
    error_log("event insert failed: " . $stmt->error);
    return false;
}

    return true;


}


}

?>