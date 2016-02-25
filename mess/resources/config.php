<?php

//turn on output buffering
ob_start();

session_start();
//session_destroy();


//define database config

defined("DB_HOST") ? null : define("DB_HOST", "127.0.0.1");
defined("DB_USER") ? null : define("DB_USER", "root");
defined("DB_PASS") ? null : define("DB_PASS", "arpit1234");
defined("DB_NAME") ? null : define("DB_NAME", "mess");


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
require_once("functions.php");

?>
