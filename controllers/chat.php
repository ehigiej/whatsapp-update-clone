<?php 
/* DISPLAY CHAT PAGE*/
/* IF NO SESSION ID REDIRECT TO LOGIN PAGE */
if(empty($_SESSION["userId"])) header("location: /");
/* GET THE userId 
IF NO USER ID redirect to users page */
if(empty($_GET["userId"])) {
    header("location: /users");
    exit;
}else { 
    $userId = $_GET["userId"];
}

/* ESTABLISH CONNECTION TO DATABASE */
$pdo = require_once "database/database.php"; 

/* FETCH THE USER's INFO FROM THE DATABASE */
$statement = $pdo->prepare("SELECT * FROM users WHERE unique_id = :userId ");
$statement->bindValue(":userId", $userId); //Bind userId as unique_id 
$statement->execute();
$userInfo = $statement->fetch(PDO::FETCH_ASSOC);

/*IF NO INFORMATION ABOUt USER FROM DATABASE REDIRECT TO USERS PAGE */
if(empty($userInfo)) header("location: /users");

require_once "views/chat.php";
?>