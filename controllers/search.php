<?php 
//SEARCH FOR A USER IN THE DATABASE 
/* check request Type and if request type is not a post register, die */
if($_SERVER["REQUEST_METHOD"] != "POST") die("No Result Found");

/* ESTABLISH CONNECTION TO DATABASE */
$pdo = require_once "database/database.php";

/* GET SEARCH WORD */
$search = $_POST["searchUser"];

/* QUERY FOR USER IN DATABASE 
SELECT ALL USERS WHERE UNIQUE_ID isn't current User's ID and have fname or lname LIKE */
$statement = $pdo->prepare("SELECT * FROM users WHERE NOT unique_id = :userId AND (fname LIKE :search OR lname LIKE :search)");
$statement->bindValue(":search", "%$search%"); //bind the search value 
$statement->bindValue(":userId", $_SESSION['userId']); //Bind the session userId 
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
/* IF NO USER, DIE */
if(empty($results)) die("No Search Result");

include_once "userMessage.php";
?>