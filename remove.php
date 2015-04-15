<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_NAME', 'dining'); 
define('DB_USER','jeff'); 
define('DB_PASSWORD','jeff');
$test = $_SESSION['Email'];

$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 


$StudentID = $_POST['StudentID'];

mysqli_query($con, "DELETE FROM employee WHERE StudentID = '$StudentID'")
or die(mysql_error());

header("Location: removeEmployee.php");

$con->close();
?>