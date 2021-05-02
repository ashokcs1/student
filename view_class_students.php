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
                        <a href="index.php">Back</a>
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
                    </div>

                    <div class="table-view-section">
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