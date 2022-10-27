<?php 

$Router = require_once "router/router.php";

/* GET THE PAGE URL */
$pageUrl = $_SERVER["REQUEST_URI"];
/* REFRACTOR PAGE URL AND GET THE PATH */
$pageUrl = parse_url($pageUrl, PHP_URL_PATH);
/* trim Page URL and Remove / */
$pageUrl = trim($pageUrl, "/");
/* GET THE PAGE REQUEST METHOD */
$requestMethod = $_SERVER["REQUEST_METHOD"];

session_start(); //start session 
require_once $Router->URL($pageUrl, $requestMethod);
?>