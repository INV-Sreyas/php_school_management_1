<?php

require_once('../utility/db_connection.php');

$result_object = mysqli_query($dbConnect,"SELECT attempts FROM login");
$row = mysqli_fetch_assoc($result_object);

date_default_timezone_set("Asia/Kolkata");  

/*the time is trimmed because, the date function returns with am/pm which
is not allowed inside sql table*/
$time = trim(date("h:i:sa", strtotime("+5 minutes")),"a,p,m");

if(($row["attempts"]>=3) && date("h:i:sa")<$time) {
    $_SESSION['login_error'] = "Error";
    echo "you have reached the invalid login limit, please try again after 5 minutes";
    mysqli_query($dbConnect,"UPDATE login SET blocked_time ='".$time."'
    WHERE username = 'admin'");
}

if(isset($_POST["username"]) && !empty($_POST["username"])) {
    if(isset($_POST["password"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        if ($username=="admin") {
            $password=$_POST["password"];
            if ($password=="admin") {
                http_response_code(200);
                echo json_encode(["message" => "login successful"]);
                mysqli_query($dbConnect,"UPDATE login SET attempts = '0'
                WHERE username = 'admin'");
                header('Location: ../dashboard.html');
            }
            else {
                http_response_code(401);
                echo json_encode(["message" => "wrong password"]);
                mysqli_query($dbConnect,"UPDATE login SET attempts = attempts+1
                WHERE username = 'admin'");
            }
        }
        else {
            http_response_code(401);
            echo json_encode(["message" => "invalid username"]);
            mysqli_query($dbConnect,"UPDATE login SET attempts = attempts+1
            WHERE username = 'admin'");
        }
    }
}
else{
    http_response_code(400);
    echo json_encode(["message" => "please enter a username"]);
    mysqli_query($dbConnect,"UPDATE login SET attempts = attempts+1
    WHERE username = 'admin'");
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
            <br>
            <label>Password :</label><br>
                <input name="password" type="password"/> <br>
            <button type="submit">login</button> <br>
            <?php
                    
                    echo $_SESSION['login_error'] ?? '';
                   ?>
        </form>
    </body>
</html>