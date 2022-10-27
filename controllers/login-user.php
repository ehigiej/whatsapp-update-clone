<?php 
//LOG IN CONTROLLER TO LOG A USER IN 
/* check request Type and if request type is not a post register, die */
if($_SERVER["REQUEST_METHOD"] != "POST") die("Not Authorized");

/* ESTABLISH CONNECTION TO DATABASE */
$pdo = require_once "database/database.php"; 

$_POST["password"] ? $password = $_POST["password"] : $password = ""; //Check if there's password in post request and set password to password 
$_POST["email"] ? $email = $_POST["email"] : $email = ""; //Check if there's email in post request and set email to email 

/*IF password or email is empty throw error */
if(empty($password) || empty($email)) die("Please Provide All Fields");

/* VALIDATE EMAIL */
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) die("Please Provide A Valid Email");

/* CHECK FOR USER IN DATABASE */
$statement = $pdo->prepare("SELECT * FROM users WHERE (email = :email AND password = :password) ");
$statement->bindValue(":email", $email);
$statement->bindValue(":password", $password);
$statement->execute();
$results = $statement->fetchALL(PDO::FETCH_ASSOC); 

/*IF NO RESULT DISPLAY USERNAME AND PASSWORD IS INCORRECT */
if(empty($results)) die("Email or Password Is Incorrect");

/* UPDATE USER STATUS IN DATABASE */
$statement = $pdo->prepare("UPDATE users SET status = :status WHERE email = :email");
$statement->bindValue(":status", "Active");
$statement->bindValue(":email", $email);
$statement->execute();
/*SET SESSION ID TO UNIQUE_ID OF USER */
$_SESSION["userId"] = $results[0]["unique_id"];
echo "success";
?>