<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_NAME', 'dining'); 
define('DB_USER','jeff'); 
define('DB_PASSWORD','jeff');
$test = $_SESSION['Email'];

$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 


$JobNumber = $_POST['JobNumber'];

mysqli_query($con, "DELETE FROM schedule WHERE JobNumber = '$JobNumber'")
or die(mysql_error());

header("Location: delete.php");

$con->close();
?>