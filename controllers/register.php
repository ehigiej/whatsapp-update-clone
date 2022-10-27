<?php 
//REGISTER A USER TO DATABASE 
/* check request Type and if request type is not a post register, die */
if($_SERVER["REQUEST_METHOD"] != "POST") die("Not Authorized");

/* ESTABLISH CONNECTION TO DATABASE */
$pdo = require_once "database/database.php"; 

$_POST["fname"] ? $fname = $_POST["fname"] : $fname = ""; //Check if there's firstname in post request and set fname to first name 
$_POST["lname"] ? $lname = $_POST["lname"] : $lname = ""; //Check if there's lastname in post request and set lname to last name 
$_POST["password"] ? $password = $_POST["password"] : $password = ""; //Check if there's password in post request and set password to password 
$_POST["email"] ? $email = $_POST["email"] : $email = ""; //Check if there's email in post request and set email to email 

/*IF fname, lname, password or email is empty throw error */
if(empty($fname) || empty($lname) || empty($password) || empty($email)) die("Please Provide All Fields");

/* NOW HANDLE USER PROFILE PICTURE 
Check if user uploaded a picture and if not throw error */
if(empty($_FILES["profile"]["tmp_name"])) die("Please Provide Profile Picture");

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

/* VALIDATE USER EMAIL TO CONFIRM IT IS A VALID EMAIL */
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) die("Please Provide A Valid Email"); 

/* QUERY THROUGH DATABASE AND CHECK IF AN ACCOUNT EXITS WITH SUCH EMAIL */
$statement = $pdo->prepare("SELECT email FROM users WHERE email = :email");
$statement->bindValue(":email", $email);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

/* IF RESULTS IS EMPTY MEANING NO USER IN DATABASE WITH EMAIL ELSE DIE */
if(!empty($results)) die("An Account Exist With This Email");

/* HANDLE USER PROFILE PICTURE */
$tmp_name = $_FILES["profile"]["tmp_name"]; //Get The IMAGE TMP NAME 
$img_type = $_FILES["profile"]["type"]; //Get The Image Type
$img_name = $_FILES["profile"]["name"];//Get The Image Name 
$extensions = ["image/png", "image/jpeg", "image/jpg"]; //Accepted Image Type for Profile Picture 

/* CHECK IF FILE UPLOADED IS THE ACCEPTED IMAGE TYPE */
if(!in_array($img_type, $extensions)) die("Please select an Image File - jpeg, png, jpg!");

/* Move Image to images folder */

/* create a new Img_path that will be uploaded in the database as location for image */
$imagePath = "images/" . randomString(5) . $img_name;
/* Move Image to images Folder in Public Directory */
move_uploaded_file($tmp_name, "public/". $imagePath);

/* REGISTER USER */
$unique_id = time(); //Create a unique_id using current time 
$statement = $pdo->prepare("INSERT INTO users (unique_id, fname, lname, email, password, img, status) 
                            VALUES (:unique_id, :fname, :lname, :email, :password, :img, :status) ");
$statement->bindValue(":unique_id", $unique_id); 
$statement->bindValue(":fname", $fname); //First Name;
$statement->bindValue(":lname", $lname); //Last Name;
$statement->bindValue(":email", $email); //Email
$statement->bindValue(":password", $password); //password 
$statement->bindValue(":img", $imagePath); 
$statement->bindValue(":status", "Active");
$statement->execute();

/* SET SESSION USER_ID TO UNIQUE_ID */
$_SESSION["userId"] = $unique_id;
echo "success"; //Successfully registered user
?>