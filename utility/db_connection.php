<?php
$username = "root";
$password = "";
$hostname = "localhost";

$dbConnect = mysqli_connect($hostname, $username, $password);

if(!$dbConnect) {
    http_response_code(500);
    die("connection failed :".mysqli_connect_error());
}
http_response_code(200);
echo "Connected Successfully";

$myqli->select_db("school_management");
?>