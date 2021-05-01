<?php
require_once "db.php";
if (isset($_POST['enroll'])) {
$name = mysqli_real_escape_string($conn, $_POST['name']);
$father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
$class = mysqli_real_escape_string($conn, $_POST['class']); 
$section = mysqli_real_escape_string($conn, $_POST['section']); 
$roll_no = mysqli_real_escape_string($conn, $_POST['class']) + mysqli_real_escape_string($conn, $_POST['section']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$dob = mysqli_real_escape_string($conn, $_POST['dob']); 
$doa = mysqli_real_escape_string($conn, $_POST['doa']);

// Name validation for special chars
if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
$name_error = "Name must contain only alphabets and space";
}

if (!preg_match("/^[a-zA-Z ]+$/",$father_name)) {
    $father_name_error = "Father Name must contain only alphabets and space";
}

     
if(strlen($phone) < 10) {
$phone_error = "Phone number must be minimum of 10 characters";
}

if (!$error) {
    $query_result =  mysqli_query($conn, "INSERT INTO student(name, roll_no, father_name, phone, address, dob, doa) 
                    VALUES('" . $name . "', '" . $roll_no . "', '" . $father_name . "', '" . $phone . "', '" . $address . "', 
                    '" . $dob . "',  '" . $doa . "')");
if($query_result) {
    echo $query_result;
header("location: enroll.php");
exit();
} else {
echo "Error: " . $sql . "" . mysqli_error($conn);
}
}
mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Enrollment Form</title>
<link href="./styles/main.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-lg-8 col-offset-2">
<div class="page-header">
<h2>Registration Form in PHP with Validation</h2>
</div>
<p>Please fill all fields in the form</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<label for="name">Name</label>
<input type="text" id="name" value="" maxlength="50" required="">
<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
<br>
<label for="father_name">Father Name</label>
<input type="text" id="father_name" value="" maxlength="50" required="">
<span class="text-danger"><?php if (isset($father_name_error)) echo $father_name_error; ?></span>
<br>
<label for="phone">Phone</label>
<input type="text" id="phone" value="" maxlength="50" required="">
<span class="text-danger"><?php if (isset($phone_error)) echo $phone_error; ?></span>
<br>
<label for="address">Address</label>
<textarea type="text" id="address" column="50" row="5" required=""></textarea>
<br>
<label for="address">Address</label>
<textarea type="text" id="address" column="50" row="5" required=""></textarea>
<br>
<label for="dob">DOB:</label>
<input type="date" id="dob">
<br>
<label for="doa">DOA:</label>
<input type="date" id="doa">
<br>
<input type="submit" class="btn btn-primary" name="enroll" value="submit">
</form>
</div>
</div>    
</div>
</body>
</html>