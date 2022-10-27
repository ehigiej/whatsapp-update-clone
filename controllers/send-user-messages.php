<?php 
//SEND A MESSAGE 
/* check request Type and if request type is not a post register, die */
if($_SERVER["REQUEST_METHOD"] != "POST") die("Not Authorized");

/* ESTABLISH CONNECTION TO DATABASE */
$pdo = require_once "database/database.php"; 

/* JUST A BIT OF SECURITY, MIGHT BE POINTLESS 
IF NO MSG IS RECEIVED OR incoming_id OR outgoing_id DO NOTHING */
if(empty($_POST["message"]) || empty($_POST["incoming_id"]) || empty($_POST["outgoing_id"])) exit;

/* INSERT MESSAGE TO DATABASE */
$message = $_POST["message"];
$outgoing_id = $_POST["outgoing_id"];
$incoming_id = $_POST["incoming_id"];

$statement = $pdo->prepare("INSERT INTO messages (incoming_id, outgoing_id, message) 
                            VALUES(:incoming_id, :outgoing_id, :message)");
$statement->bindValue(":incoming_id", $incoming_id); //Bind incoming Id 
$statement->bindValue(":outgoing_id", $outgoing_id); //Bind Outgoing_id 
$statement->bindValue(":message", $message); //Bind Message 
$statement->execute();
echo "success";
?>