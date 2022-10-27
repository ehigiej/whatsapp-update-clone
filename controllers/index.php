<?php 
/* CHECK IF USER IS LOGGED IN AND REDIRECT USER TO CHAT PAGE */
if(!empty($_SESSION["userId"])) header("location: /chat");
/* DISPLAY REGISTER PAGE */
require_once "views/signup.php";
?>