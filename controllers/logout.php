<?php
/* IF NO SESSION ID REDIRECT TO LOGIN PAGE */
if(empty($_SESSION["userId"])) header("location: /");
/* GET THE userId 
 IF NO USER ID redirect to users page */
if(empty($_GET["userId"])) {
    header("location: /users");
}else { 
    $userId = $_GET["userId"];
}

/* ESTABLISH CONNECTION TO DATABASE */
$pdo = require_once "database/database.php"; 

/* LOG USER OUT 
DELETE SESSIONS AND CHANGE USER STATUS IN DATABASE TO OFFLINE */
$statement = $pdo->prepare("UPDATE users SET status = :status WHERE unique_id = :userId");
$statement->bindValue(":status", "Offline");
$statement->bindValue(":userId", $userId);
$statement->execute();

session_unset(); //Delete all sessions
session_destroy(); //distroy sessions

header("location: /") //redirect to login page 
?>