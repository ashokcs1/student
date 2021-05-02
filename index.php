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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link rel="stylesheet" href="styles/main-new.css">
    <link rel="stylesheet" href="styles/class.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts/functions.js"></script>
</head>

<body>
    <header>
        <div class="head-section">
            <div class="head-img">
                <img src="./images/student.png" alt="Header Image">
            </div>
            <div class="heading-section">
                <h2>Student Management System</h2>
                <h3>Manage your students information</h3>
            </div>
        </div>
    </header>
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="class-tab" data-toggle="tab" href="#class" role="tab" aria-controls="class" aria-selected="false">Class</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="false">Student</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="class" role="tabpanel" aria-labelledby="class-tab">
                <div>

                    <div class="sub-heading">
                        <a href="create_class.php">Create Class</a>
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
                </div>
            </div>
            <div class="tab-pane fade" id="student" role="tabpanel" aria-labelledby="student-tab">...</div>
        </div>
    </div>
    <footer>
        Copyright
    </footer>
</body>

</html>