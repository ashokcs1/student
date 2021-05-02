<?php
require_once "db.php";
$actual_link = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$parts = parse_url($actual_link);
parse_str($parts['query'], $query);
$class_id = $query['id'];

$sql_class_students = "SELECT S.id, S.roll_no, S.name, S.father_name, S.phone, S.address, S.dob, S.doa, CT.class, CT.section_name, CT.teacher_name FROM student AS S LEFT JOIN (SELECT C.id, c.class, c.section_name, T.name AS teacher_name FROM class AS C LEFT JOIN teacher AS T ON c.teacher_id = T.id) AS CT ON S.class_id = CT.id WHERE S.class_id =$class_id";
$class_students_result = mysqli_query($conn, $sql_class_students);

$sql_class = "SELECT C.id, c.class, c.section_name, T.name AS teacher_name FROM class AS C LEFT JOIN teacher AS T ON c.teacher_id = T.id WHERE C.id=$class_id";
$class_result = mysqli_query($conn, $sql_class);
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
    <div><a href="view_class.php">Back</a></div>
    <?php
    if ($class_result->num_rows > 0) {
        // output data of each row
        while ($row = $class_result->fetch_assoc()) {
    ?>
            <h2>Students Enrolled in <?php echo $row["class"] . $row["section_name"]  ?></h2>
    <?php
        }
    }
    ?>
    <table>
        <tr>
            <th>Student Id</th>
            <th>Roll No</th>
            <th>Name</th>
            <th>Father Name</th>
            <th>Phone</th>
            <th>Date of Birth</th>
            <th>Date of Admission</th>
        </tr>

        <?php
        if ($class_students_result->num_rows > 0) {
            // output data of each row
            while ($row = $class_students_result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["roll_no"] ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["father_name"] ?></td>
                    <td><?php echo $row["phone"] ?></td>
                    <td><?php echo $row["dob"] ?></td>
                    <td><?php echo $row["doa"] ?></td>
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