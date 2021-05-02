<?php
require_once "db.php";
if (isset($_POST['name'])) {
$name = $_POST['name'];
$father_name =$_POST['father_name'];
$class_id = $_POST['class_id'];
$class_name = str_replace("-","", $_POST['class_name']);
$phone = $_POST['phone'];
$address = $_POST['address'];
$dob = $_POST['dob']; 
$doa = $_POST['doa'];
$roll_no = '';
$query_result = mysqli_query($conn, "SELECT count(*) AS COUNT FROM student WHERE class_id='". $class_id ."'");
while($row = mysqli_fetch_array($query_result)){  
    $next_rollno = (int)$row['COUNT']+1;     
    $roll_no = $class_name . $next_rollno ;
} 

$query_result =  mysqli_query($conn, "INSERT INTO student(name, roll_no, father_name, phone, address, dob, doa, class_id) 
VALUES('" . $name . "', '" . $roll_no . "', '" . $father_name . "', '" . $phone . "', '" . $address . "', 
'" . $dob . "',  '" . $doa . "',  '" . $class_id . "')");
if($query_result) {
    echo $query_result;
    header("location: enroll.php");
    echo "Success: ";
    exit();
} else {
    echo "Error: ". mysqli_error($conn);
}   

mysqli_close($conn);
}
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
<script>
    function setSelectedClassValue(){
        var val = document.getElementById("class_field");
        document.getElementById("class_name_field").value = val.options[val.selectedIndex].text;
        document.getElementById("class_id_field").value = val.options[val.selectedIndex].value;
    }
</script>
<header>
    <img src="./images/student.png" alt="Header Image">
	<h2>Student Management System</h2>
	<h3>Manage your students information</h3>
</header>
<nav id="nav_menu">
    	<ul>
        	<li><a href="#" class="current">Student Enroll</a></li>
			<li><a href="./create_class.php">Create class</a></li>
        	<li><a href="./view_class.php">View Class</a></li>
        	<li><a href="./view_student.php">View Student</a></li>
    	</ul>
</nav>
<h2 id="form-title">Student Enrollment Form</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="name_field">Name:</label>
    <input class="student-input" type="text" id="name_field" name="name" value="" maxlength="50" required="">
    <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
    <br>
    <label for="father_name_field">Father Name:</label>
    <input class="student-input" type="text" id="father_name_field" name="father_name" value="" maxlength="50" required>
    <span class="text-danger"><?php if (isset($father_name_error)) echo $father_name_error; ?></span>
    <br>
    <label for="phone_field">Phone:</label>
    <input class="student-input" type="text" id="phone_field" name="phone" value="" maxlength="50" required>
    <span class="text-danger"><?php if (isset($phone_error)) echo $phone_error; ?></span>
    <br>
    <label for="address_field">Address:</label>
    <textarea class="student-textarea" type="text" id="address_field" name="address" cols="30" rows="5" required></textarea>
    <br>
    <label for="dob_field">DOB:</label>
    <input class="student-input" type="date" id="dob_field" name="dob">
    <br>
    <label for="doa">DOA:</label>
    <input class="student-input" type="date" id="doa" name="doa">
    <br>
    <label for="class_field">Class:</label>
    <select name="class" id="class_field" onchange="setSelectedClassValue()">
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
    echo "<input type='hidden' id='class_name_field' name='class_name'>";
    echo "<input type='hidden' id='class_id_field' name='class_id'>";
    ?>
    <br>
    <div class="buttons">
        <input type="submit" class="button-submit" value="Submit" onclick="setSelectedClassValue()">
        <input type="reset" class="button-submit" value="Reset">
    </div>
</form>
</body>
</html>