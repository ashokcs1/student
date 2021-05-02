<?php
$servername='bcj1nlpdqi8j7sjsipbx-mysql.services.clever-cloud.com';
$username='ucfrgh7p8hufd5km';
$password='7aQFuqO0iAqMje7EM53u';
$dbname = "bcj1nlpdqi8j7sjsipbx";
$conn = mysqli_connect($servername,$username,$password,$dbname);
  if(!$conn){
      die('Could not Connect MySql Server:' .mysqli_connect_error($conn));
    }
?>