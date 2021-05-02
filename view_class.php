<?php
require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Classes</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/class.css">
</head>
<header>
    <img src="./images/student.png" alt="Header Image">
    <h2>Student Management System</h2>
    <h3>Manage your students information</h3>
</header>

<body>

    <h2>Classes</h2>

    <table>
        <tr>
            <th>Class Name</th>
            <th>Section Name</th>
            <th>Teacher</th>
        </tr>

        <?php
        // fetch teachers data  
        $sql_teachers = "SELECT * FROM class";
        $teacher_result = mysqli_query($conn, $sql_teachers);
        if ($teacher_result->num_rows > 0) {
            // output data of each row
            while ($row = $teacher_result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $row["class"] ?></td>
                    <td><?php echo $row["section_name"] ?></td>
                    <td><?php echo $row["teacher"] ?></td>
                </tr>
        <?php
            }
        }
        ?>
        <tr>
        </tr>
    </table>
</body>

</html>