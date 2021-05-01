<?php
echo 'hello world';
$servername='localhost';
$username='root';
$password='root';
$dbname = "school";
$conn = mysqli_connect($servername,$username,$password,"$dbname");
  if(!$conn){
      die('Could not Connect MySql Server:' .mysql_error());
    }
    else{
        echo '<br>db connection success';
    }
?>