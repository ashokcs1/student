<?php
require_once "db.php";
if (isset($_POST['action']) && isset($_POST['id'])) {
    $class_id = $_POST['id'];
    if ($_POST['action'] == 'View Enrolled Students') {
        // edit the post with $_POST['id']
        header("location: view_class_students.php?id=$class_id");
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
    <title>Classes</title>
    <link rel="stylesheet" href="styles/class.css">
</head>

<body>
    <div class="sub-heading">
        <a onclick="showCreateClass()" href="#">Create Class</a>
        <h2>Classes</h2>
    </div>

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
                                <input type="submit" name="action" value="View Enrolled Students" />
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
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
</body>

</html>