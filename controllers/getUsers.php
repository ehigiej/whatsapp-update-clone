<?php 
/* THIS IS FOR CHATS TO DISPLAY ALL USERS EXCEPT CURRENT USER AND ALSO DISPLAY THE IF USER HAS A STATUS THAT HASN'T BEEN VIEWED YET 
AND ALSO THE LAST CHAT BETWEEN LOGGED IN USER AND USER  */
//GET ALL THE USERS
require_once "update-status.php"; //Get The Latest Status 

/* QUERY FOR ALL USERS EXCEPT CURRENT USER */
$statement = $pdo->prepare("SELECT * FROM users WHERE NOT unique_id = :userId ");
$statement->bindValue(":userId", $_SESSION["userId"]);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

/* IF NO USER, DIE */
if(empty($results)) die("No Users Available");
include_once "userMessage.php";
?>