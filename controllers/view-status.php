<?php 
/* FETCH STATUS FROM DATABASE AND DISPLAY IT */
/* IF NO USER, REDIRECT TO HOME PAGE */
if(empty($_SESSION["userId"])) header("location: /");
/* IF THERE IS NOT USERID or StatusId query, redirect to status page*/
if(empty($_GET["userId"]) || empty($_GET["statusId"])) header("location: /status");
$userId = $_GET["userId"]; //Set UserId to Status PostedBy Id 
$statusId = $_GET["statusId"]; //Set StatusId to statusId 

/* ESTABLISH CONNECTION TO DATABASE */
$pdo = require_once "database/database.php";
require_once "calculateTime.php"; //Calculate 

/* FIRST GET STATUS INFORMATION */
$statement = $pdo->prepare("SELECT * FROM status 
                            LEFT JOIN users ON users.unique_id = status.postedBy
                            WHERE (status_id = :statusId AND postedBy = :postedBy)");
$statement->bindValue(":statusId", $statusId);
$statement->bindValue(":postedBy", $userId);
$statement->execute();
$currentStatus = $statement->fetch(PDO::FETCH_ASSOC);
if(empty($currentStatus)) {
    header("location: /status");
    exit;
}
$lastStatusTimeString = $currentStatus["created_at"]; //Get The Last Status Created_at time 
$dateDiffString = calculateTime($lastStatusTimeString); //Calculate time difference from current time to created_at time 

if($userId != $_SESSION["userId"]) {
    /* ADD CURRENT STATUS TO VIEWED STATUS 
    PREVENT DUPLICATE INSERT, SO FIRST CHECK IF IT EXITS OTHERWISE INSERT */
    $statement = $pdo->prepare("SELECT * FROM views WHERE (status_id = :statusId AND userId = :userId)");
    $statement->bindValue(":statusId", $statusId);
    $statement->bindValue(":userId", intval($_SESSION["userId"]));
    $statement->execute();
    $alreadyExit = $statement->fetchAll(PDO::FETCH_ASSOC);
    if(empty($alreadyExit)) {
        $statement = $pdo->prepare("INSERT INTO views (status_id, userId)
        VALUES (:statusId, :userId) ");
        $statement->bindValue(":statusId", $statusId);
        $statement->bindValue(":userId", $_SESSION["userId"]);
        $statement->execute();
    }
}

/* CHECK IF THERE"S A PREVIOUS STATUS POSTED BY THIS USER BEFORE THIS CURRENT STATUS */
$statement = $pdo->prepare("SELECT * FROM status 
                            WHERE (id < :id AND postedBy = :postedBy) ORDER BY id DESC LIMIT 1");
$statement->bindValue(":id", $currentStatus["id"]);
$statement->bindValue(":postedBy", $userId);
$statement->execute();
$previousStatus = $statement->fetch(PDO::FETCH_ASSOC);

/* CHECK IF THERE'S A NEXT STATUS AFTER CURRENT STATUS */
$statement = $pdo->prepare("SELECT * FROM status 
                            WHERE (id > :id AND postedBy = :postedBy) ORDER BY id ASC LIMIT 1");
$statement->bindValue(":id", $currentStatus["id"]);
$statement->bindValue(":postedBy", $userId);
$statement->execute();
$nextStatus = $statement->fetch(PDO::FETCH_ASSOC);

require_once "views/view-status.php"
?>