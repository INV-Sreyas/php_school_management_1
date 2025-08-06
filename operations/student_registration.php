<?php

require_once("../utility/db_connection.php");

if(isset($_POST["name"]) && !empty($_POST["name"])) {
    $name = trim($_POST["name"]); //sanitizing the name
    
    //code for pattern matching
    if(preg_match('/^[a-zA-Z]{2,}$/',$name)) {
        
        if(isset($_POST["registration_number"]) && !empty($_POST["registration_number"])) {
            $registration_number = $_POST["registration_number"];
            
            //code for pattern matching
            if(preg_match('/^(REG)-200[0-7]-(\d{4})$/',$registration_number)) {
                
                if(isset($_POST["email"]) && !empty($_POST["email"])) {
                    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);  //email is sanitized then stored
                    
                    //code for email validation
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        echo "the entered email is invalid";
                        exit;
                    }
                    else {
                        //email is unique for every user, checking for that
                        $result_set = mysqli_query($dbConnect, "SELECT name FROM student 
                        WHERE email = '".$email."'");
                        $row = mysqli_fetch_assoc($result_set);
                        
                        if(!empty($row["name"])) {
                            echo "please try with a different email, this one is already registered";
                            exit;
                        }
                        
                        if(isset($_POST["phone_number"]) && !empty($_POST["phone_number"])) {
                            $phone_number = $_POST["phone_number"];
                            
                            //code for pattern matching
                            if(preg_match('/^[0-9]{10}$/', $phone_number)){
                                if(isset($_POST["course"]) && !empty($_POST["course"])) {
                                    $course = $_POST["course"];

                                    //insertion of student values to DB
                                    mysqli_query($dbConnect,"INSERT INTO student
                                    (name,registration_number,email,phone_number,course)
                                    VALUES('".$name."','".$registration_number."',
                                    '".$email."','".$phone_number."',
                                    '".$course."')");
                                    echo "student creation successful";
                                }
                                else {
                                    echo "please choose a course";
                                }
                            }
                            else {
                                echo "please enter a valid phone number";
                            }
                        }
                        else {
                            echo "please enter a phone number";
                        }
                    }
                }
            }
        }
        else {
            echo "please enter register number";
        }
    }
    else {
        echo "please enter a name having atleast 2 letters";
    }
}
else {
    echo "please enter a name";
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Student Registration</title>
    </head>

    <body>
        <form action="student_registration.php" method="POST">
            <label>name</label><br>
            <input type = "text" name= "name"/>
            <br><label>registration_number</label><br>
            <input type = "text" name= "registration_number"/>
            <br><label>email</label><br>
            <input type = "email" name = "email"/>
            <br><label>phone_number</label><br>
            +91-<input type = "text" name = "phone_number"/>
            <br><label>course</label><br>
            <select name = "course">
                <option value = ""> -- </option>
                <option value = "bca"> BCA </option>
                <option value = "mca"> MCA </option>
                <option value = "btech"> B.Tech </option>
                <option value = "mtech"> M.Tech </option>
            </select>
            <input type = "submit" value = "Submit"/>
    </body>
</html>