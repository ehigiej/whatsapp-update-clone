<?php 
//Upload Status to database 
/* check request Type and if request type is not a post register, die */
if($_SERVER["REQUEST_METHOD"] != "POST") die("Not Authorized");
/* also check if user is logged in */
if(empty($_SESSION["userId"])) die("Not Authorized");

/* ESTABLISH CONNECTION TO DATABASE */
$pdo = require_once "database/database.php";

/* NOW HANDLE UPLOADING STATUS TO DATABASE 
Check if user uploaded a picture and if not throw error */
if(empty($_FILES["status"]["tmp_name"])) die("Please select an Image File - jpeg, png, jpg!");

/* Create a function to genereate random letters */
function randomString($n) {
    $characters = '0123456789abcdefghijklmopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    } 
    return $str;
}

/* CHECK IF FILE UPLOADED IS A VALID FORMAT */
$extensions = ["image/png", "image/jpeg", "image/jpg"]; //Accepted Image Type for Status
$imgType = $_FILES["status"]["type"]; //Get The Image Type 
$tmp_name = $_FILES["status"]["tmp_name"];
$img_name = $_FILES["status"]["name"]; //Get The Image Name 

/* If status is not a valid type throw an Error */
if(!in_array($imgType, $extensions)) die("Please select an Image File - jpeg, png, jpg!");

/* Create the unique Image Path */
$imagePath = "images/status/" . randomString(5) . $img_name; 
/* SET status Upload Date to current Date */
$statusDate = date("Y-m-d H:i");
$statusId = time(); //Set current time as statusId

/* Insert Status Details To The Database */
$statement = $pdo->prepare("INSERT INTO status (status_id, file, created_at, postedBy)
                            VALUES (:statusId, :file, :createdAt, :postedBy)");
$statement->bindValue(":statusId", $statusId); //Bind The Status Id 
$statement->bindValue(":file", $imagePath); //Bind the Image Path 
$statement->bindValue(":createdAt", $statusDate); //Bind the status Date 
$statement->bindValue(":postedBy", $_SESSION["userId"]); //Bind the postedBy 
$statement->execute();

/* MOVE IMAGE TO PUBLIC */
move_uploaded_file($tmp_name, "public/" . $imagePath);
echo "success";
?>