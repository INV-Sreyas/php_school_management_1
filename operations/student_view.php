<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
</head>
<body>
<table border = "1">
    <?php
    require_once("../utility/db_connection.php");

    $result_set = mysqli_query($dbConnect, "SELECT * FROM student");

    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Registration Number</th>";
    echo "<th>Email</th>";
    echo "<th>Phone Number</th>";
    echo "<th>Course</th>";
    echo "</tr>";
    
    for($i = mysqli_num_rows($result_set); $i > 0; $i--) {
        $row = mysqli_fetch_assoc($result_set);
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['registration_number']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['phone_number']."</td>";
        echo "<td>".$row['course']."</td>";
        echo "</tr>";
    }

    ?>
</table>
</body>
</html>