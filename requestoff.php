<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_NAME', 'dining'); 
define('DB_USER','jeff'); 
define('DB_PASSWORD','jeff');
$test = $_SESSION['Email'];

$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 


$query = mysqli_query($con, "SELECT StudentID FROM employee WHERE Email = '$test'");
$row = mysqli_fetch_array($query); 
$studentID = $row['StudentID'];

$query = mysqli_query($con, "SELECT JobNumber FROM schedule WHERE studentID = '$studentID'");
$row = mysqli_fetch_array($query); 
$JobNumber = $row['JobNumber'];


$sql = "INSERT INTO requests (StudentID1,StudentID2,JobNumber,RequestType) VALUES($studentID,null,$JobNumber,'drop')";

if ($con->query($sql) === TRUE) {
    echo "Request Sent";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
?>