<?php
/* CHECK IF USER IS LOGGED IN AND REDIRECT USER TO CHAT PAGE */
if(!empty($_SESSION["userId"])) header("location: /chat");
//Display Login Page 
require_once "views/login.php";
?>