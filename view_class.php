<?php
require_once "db.php";
if (isset($_POST['action']) && isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    if ($_POST['action'] == 'View Enrolled Students') {
        // edit the post with $_POST['id']
        header("location: view_student.php?class_id=$class_id");
        echo "Success: ";
        exit();
    }
}

// fetch teachers data  
$sql_teachers = "SELECT A.id, A.class, A.section_name, A.teacher_name, COUNT(S.id) AS total_students FROM (SELECT C.id, c.class, c.section_name, T.name AS teacher_name FROM class AS C LEFT JOIN teacher AS T ON c.teacher_id = T.id) AS A LEFT JOIN student AS S ON S.class_id =A.id GROUP BY A.id;";
$teacher_result = mysqli_query($conn, $sql_teachers);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Enrollment Form</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
</head>

<body>
    <header>
        <img src="./images/student.png" alt="Header Image">
        <h2>Student Management System</h2>
        <h3>Manage your students information</h3>
    </header>
    <nav id="nav_menu">
        <ul>
            <li><a href="./enroll.php">Student Enroll</a></li>
            <li><a href="./create_class.php">Create class</a></li>
            <li><a href="#" class="current">View Class</a></li>
            <li><a href="./view_student.php">View Student</a></li>
        </ul>
    </nav>
    <h2 id="form-title">List of Classes</h2>

    <div class="table-view-section">
        <table>
            <tr>
                <th>Class Name</th>
                <th>Section Name</th>
                <th>Teacher</th>
                <th>Total Students</th>
                <th>Action</th>
            </tr>

            <?php
            if ($teacher_result->num_rows > 0) {
                // output data of each row
                while ($row = $teacher_result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row["class"] ?></td>
                        <td><?php echo $row["section_name"] ?></td>
                        <td><?php echo $row["teacher_name"] ?></td>
                        <td><?php echo $row["total_students"] ?></td>
                        <td>
                            <form method="post" class="action-width">
                                <input type="submit" class="button-view" name="action" value="View Enrolled Students" />
                                <input type="hidden" name="class_id" value="<?php echo $row['id']; ?>" />
                            </form>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
            <tr>
            </tr>
        </table>
    </div>
    <footer>
        <p>&copy; Copyright Aravind, Ashok. </p>
    </footer>
</body>

</html>