<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Enrollment Form</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
</head>

<body>
<?php
    require_once "db.php";
    if (isset($_POST['class'])) {
        $class = $_POST['class'];
        $section_name = $_POST['section_name'];
        $teacher_id = $_POST['teacher_id'];
        $query_result =  mysqli_query($conn, "INSERT INTO class(class, section_name, teacher_id) VALUES('" . $class . "', '" . $section_name . "', '" . $teacher_id . "')");
        if ($query_result) {
            echo $query_result;
            header("location: create_class.php?message=success");
            echo "<script>alert('Success!!');</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

    mysqli_close($conn);
    }
    if (isset($_GET['message'])) {
        echo "<script>alert('Success!!');</script>";
    }
    ?>
    <header>
        <img src="./images/student.png" alt="Header Image">
	    <h2>Student Management System</h2>
	    <h3>Manage your students information</h3>
    </header>
    <nav id="nav_menu">
    	<ul>
        	<li><a href="./enroll.php">Student Enroll</a></li>
			<li><a href="#" class="current">Create class</a></li>
        	<li><a href="./view_class.php">View Class</a></li>
        	<li><a href="./view_student.php">View Student</a></li>
    	</ul>
    </nav>
    <h2 id="form-title">Create Class</h2>

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
                        <select class="student-input" name="teacher_id" id="teacher_id" required>
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
            <footer>
                <p>&copy; Copyright Aravind, Ashok. </p>
            </footer>
</body>

</html>