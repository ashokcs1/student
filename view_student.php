<?php
require_once "db.php";
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
        	<li><a href="./view_class.php">View Class</a></li>
        	<li><a href="#" class="current">View Student</a></li>
    	</ul>
</nav>
<h2 id="form-title">View Student</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
    <label for="roll_no_field">Roll No:</label>
    <input class="student-input" type="text" id="roll_no_field" name="roll_no">
    <p>----  Or ----</p>
    <label for="class_field">Class:</label>
    <select name="class_id" id="class_field" onchange="setSelectedClassValue()">
    <?php 
        $result = mysqli_query($conn, "SELECT * FROM `class`");
        $class_name = "";
        echo "<option class='student-input' name='' value='choose'>Choose</option>";
        while($row = mysqli_fetch_array($result)){       
            $class_name = $row['class'] . '-'. $row['section_name'];
            echo "<option class='student-input' name='". $row['id'] ."' 
                value='". $row['id'] ."'>". $class_name ."</option>";
        }
    
        echo "</select>";
    ?>
    <div class="buttons">
        <input type="submit" class="button-submit" onclick="addStudentData()" Value="Submit"/>
    </div>
<hr>
<h3 id="form-title">List of Students in Class: </h3> <h2 id="class_name_value"> </h2>
    <table id="student_table">
        <tr>
            <th>Roll no</th>
            <th>Name</th>
            <th>Father Name</th>
            <th>Phone</th>
            <th>DOB</th>
        </tr>
    </table>
</form>
<script>
    var table = document.getElementById('student_table');
    table.style.visibility = 'hidden';
</script>
<?php
if (isset($_GET['roll_no']) and !empty($_GET['roll_no'])) {
    $roll_no = $_GET['roll_no'];
    $query_result = mysqli_query($conn, "SELECT * FROM student WHERE roll_no='". $roll_no ."'");
    while($row = mysqli_fetch_array($query_result)){  
        echo "<script>
        addStudentData();
        var table = document.getElementById('student_table');
        table.style.visibility = 'visible';
            function addStudentData() {
                var row = table.insertRow(1);
                var rollNo = row.insertCell(0);
                var name = row.insertCell(1);
                var fatherName = row.insertCell(2);
                var phone = row.insertCell(3);
                var dob = row.insertCell(4);
                rollNo.innerHTML ='". $row['roll_no'] ."';
                name.innerHTML ='".   $row['name'] ."';
                fatherName.innerHTML ='".   $row['father_name'] ."';
                phone.innerHTML ='".   $row['phone'] ."';
                dob.innerHTML ='".  $row['dob'] ."';
                table.style.visibility = 'visible';
            }
        </script>";
    }  
}
else if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
    $query_result = mysqli_query($conn, "SELECT * FROM class WHERE id='". $class_id ."'");
    while($row = mysqli_fetch_array($query_result)){  
        $class_name =  $row['class'] . $row['section_name'];
        echo "<script>
                var classNameValue = document.getElementById('class_name_value').innerHTML = '". $class_name ."';
                </script>";
    }
    $query_result = mysqli_query($conn, "SELECT * FROM student WHERE class_id='". $class_id ."'");
    while($row = mysqli_fetch_array($query_result)){  
        echo "<script>
        addStudentData();
        var table = document.getElementById('student_table');
        table.style.visibility = 'visible';
            function addStudentData() {
                var row = table.insertRow(1);
                var rollNo = row.insertCell(0);
                var name = row.insertCell(1);
                var fatherName = row.insertCell(2);
                var phone = row.insertCell(3);
                var dob = row.insertCell(4);
                rollNo.innerHTML ='". $row['roll_no'] ."';
                name.innerHTML ='".   $row['name'] ."';
                fatherName.innerHTML ='".   $row['father_name'] ."';
                phone.innerHTML ='".   $row['phone'] ."';
                dob.innerHTML ='".  $row['dob'] ."';
                table.style.visibility = 'visible';
            }
        </script>";
    }   
}

mysqli_close($conn);
?>
<footer>
        <p>&copy; Copyright Aravind, Ashok. </p>
</footer>
</body>
</html>