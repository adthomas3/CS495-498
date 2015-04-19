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

$JobNumber = $_POST['JobNumber'];


$ScheduleQuery = sprintf("SELECT Unit, Job, StartTime, EndTime, Day FROM schedule Where JobNumber = '%s'", $JobNumber);
$QueryResult = mysqli_query($con, $ScheduleQuery);
$row2 = mysqli_fetch_array($QueryResult);
$Unit = $row2['Unit'];
$Job = $row2['Job'];
$StartTime = $row2['StartTime'];
$EndTime = $row2['EndTime'];
$Day = $row2['Day'];

$sql = "INSERT INTO requests (StudentID1,StudentID2,JobNumber,RequestType,Unit,Job,StartTime,EndTime,Day)
   	 VALUES($studentID,0,$JobNumber,'Trade','$Unit','$StartTime', '$Job', '$EndTime','$Day')";

if ($con->query($sql) === TRUE) {
    echo "Request Sent";
	header("Location: student.php");
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
?>