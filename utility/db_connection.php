<?php

//this part is to set error reporting to true(without this error won't be displayed)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$username = "root";
$password = "";
$hostname = "localhost";

$dbConnect = mysqli_connect($hostname, $username, $password);

if(!$dbConnect) {
    http_response_code(500);
    die("connection failed :".mysqli_connect_error()."<br>");
}
else {
    http_response_code(200);
    echo "Connected Successfully<br>";
}

if(!mysqli_select_db($dbConnect,"school_management_system")) {
    http_response_code(500);
    die("connection failed :".mysqli_connect_error()."<br>");
}
else {
    http_response_code(200);
    echo "Connected to the db successfully<br>";
}
?>