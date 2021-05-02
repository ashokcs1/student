<?php
require_once "db.php";

if (isset($_POST['class'])) {
    $class = $_POST['class'];
    $section_name = $_POST['section_name'];
    $teacher_id = $_POST['teacher_id'];
    $query_result =  mysqli_query($conn, "INSERT INTO class(class, section_name, teacher_id) 
VALUES('" . $class . "', '" . $section_name . "', '" . $teacher_id . "')");
    if ($query_result) {
        echo $query_result;
        header("location: create_class.php");
        echo "Success: ";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
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
                        <h2>Create Class</h2>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <label for="class_name">Class Name:</label>
                        <input class="student-input" type="text" id="class_name" name="class" value="" maxlength="2" required="">
                        <span class="text-danger"><?php if (isset($class_name_error)) echo $name_error; ?></span>
                        <br>
                        <label for="section_name">Section Name:</label>
                        <input class="student-input" type="text" id="section_name" name="section_name" value="" maxlength="3" required>
                        <span class="text-danger"><?php if (isset($section_name_error)) echo $father_name_error; ?></span>
                        <br>
                        <label for="teacher_id">Teacher:</label>
                        <select class="input-select" name="teacher_id" id="teacher_id" required>
                            <?php
                            // fetch teachers data  
                            $sql_teachers = "SELECT id, name FROM teacher";
                            $teacher_result = mysqli_query($conn, $sql_teachers);
                            if ($teacher_result->num_rows > 0) {
                                // output data of each row
                                while ($row = $teacher_result->fetch_assoc()) {
                            ?>
                                    <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="text-danger"><?php if (isset($teacher_error)) echo $teacher_error; ?></span>
                        <br>
                        <div class="buttons">
                            <input type="submit" class="button-submit" value="Save">
                            <input type="reset" class="button-submit" value="Clear">
                        </div>
                    </form>
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