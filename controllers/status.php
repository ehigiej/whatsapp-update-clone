<?php 
/* DISPLAY USER"S STATUS PAGE */

/* FIRST CHECK IF THERE"S A USER, ELSE REDIRECT TO LOGIN PAGE */
if(empty($_SESSION["userId"])) {
    header("location: /");
} 

/* ESTABLISH CONNECTION TO DATABASE */
$pdo = require_once "database/database.php"; 

/* QUERY FOR USER"S INFORMATION */
$statement = $pdo->prepare("SELECT * FROM users WHERE unique_id = :userId");
$statement->bindValue(":userId", $_SESSION["userId"]);
$statement->execute();
$userInfo = $statement->fetch(PDO::FETCH_ASSOC);

/* IF no user Info redirect to login page */
if(empty($userInfo)) header("location: /");
require_once "views/status.php";
?>