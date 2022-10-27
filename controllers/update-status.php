<?php
//Retrieve status from Database  
/* check if user is logged in */
if(empty($_SESSION["userId"])) die("Not Authorized");

/* ESTABLISH CONNECTION TO DATABASE */
$pdo = require_once "database/database.php";
require_once "calculateTime.php";
require_once "delete-status.php"; //First Delete Status with 24hr upload diff to current Time

/* QUERY FOR USER"S INFORMATION */
$statement = $pdo->prepare("SELECT * FROM users WHERE unique_id = :userId");
$statement->bindValue(":userId", $_SESSION["userId"]);
$statement->execute();
$userInfo = $statement->fetch(PDO::FETCH_ASSOC);

/* GET ALL STATUS AND THE RESPECTIVE USER's INFORMATION */
$statement = $pdo->prepare("SELECT * FROM status 
                            LEFT JOIN users ON users.unique_id = status.postedBy
                            ORDER BY id desc");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC); 

/* REARRANGE RESULTS ACCORDING TO USERID(KEY) AND STATUS(VALUE) PAIR 
SAVE KEY VALUE PAIR IN ALLSTATUS ARRAY */
$allStatus = [];

foreach ($results as $key => $value) {
    /* APPEND RESULTS TO allStatus */
    $allStatus[$value["postedBy"]][] = $value;
}

/* CREATE TWO ARRAYS, ONE FOR STATUS UPDATE(NEW STATUS THAT HASN"T BEEN VIEWED BY LOGGED IN USER) AND 
VIEWEDSTATUS (FOR STATUS THAT HAS BEEN VIEWED BY LOGGED IN USER) */
$updateStatus = []; //basically get the status that have not been viewed
$viewedStatus = [];

/* FOR UPDATE STATUS
Create a viewedCount to check if the number of status posted by the user has been viewed by the logged in user 
then move status to viewedStatus else move status to update status */
foreach ($allStatus as $key => $value) {
    //loop through values 
    $viewedCount = 0;
    foreach($value as $key1 => $value1) {
        /* CHECK THROUGH ALL STATUS AND CHECK IF THERE EXIST A COLUMN WITH STATUS ID AND LOGGED IN USER ID */
        $statement = $pdo->prepare("SELECT * FROM views WHERE ( status_id = :status_id AND userId = :userId) ");
        $statement->bindValue(":status_id", $value1["status_id"]);
        $statement->bindValue("userId", $_SESSION["userId"]);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        //check if any results where found 
        if(empty($results)) {
            /* MEANING THE STATUS WASN"T VIEWED BY THE LOGGED IN USER */
            $updateStatus[$key][] = $value1;
        } else {
            ++$viewedCount;
        }
    }
    /* Check for viewed status 
    if viewedCount is equal to the number of status posted by the user (someone, NOT CURRENT USER) 
    it means current logged in user has viewed every status posted by this user 
    so move status to viewedStatus*/
    if(count($value) == $viewedCount) {
        $viewedStatus[$key] = $value;
    }
}
?>