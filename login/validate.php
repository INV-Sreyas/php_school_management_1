<?php

require_once('../utility/db_connection.php');

if(isset($_POST["username"]) && !empty($_POST["username"])) {
    if(isset($_POST["password"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        if ($username=="admin") {
            $password=$_POST["password"];
            if ($password=="admin") {
                http_response_code(200);
                echo json_encode(["message" => "login successful"]);
                $failed_attempts = 0;
            }
            else {
                http_response_code(401);
                echo json_encode(["message" => "wrong password"]);
                $failed_attempts++;
            }
        }
        else {
            http_response_code(401);
            echo json_encode(["message" => "invalid username"]);
            $failed_attempts++;
        }
    }
}
else{
    http_response_code(400);
    echo json_encode(["message" => "please enter a username"]);
    $failed_attempts++;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>login page</title>
    </head>

    <body>
        <h1>LOGIN</h1>
        <form method = "POST" action = "validate.php">
            <label>Username :</label><br>
                <input name="username" type="text"/> 
            <label>Password :</label><br>
                <input name="password" type="password"/>
            <button type="submit">login</button>
        </form>
    </body>
</html>