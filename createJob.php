<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'dining'); 
define('DB_USER','jeff'); 
define('DB_PASSWORD','jeff'); 
    
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
//$studentID = $_POST['studentID'];
//$password = $_POST['password'];

function NewJob()
{
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
    $Unit= $_POST['Unit'];
    $Job = $_POST['Job'];
    $StartTime = $_POST['StartTime'];
    $EndTime = $_POST['EndTime'];
    $JobNumber = $_POST['JobNumber'];
    $Day = $_POST['Day'];
	$StudentID = 0;
    $insert = "INSERT INTO schedule (Unit, Job, StartTime, EndTime, JobNumber, Day, StudentID)
              VALUES
              ('$Unit','$Job','$StartTime','$EndTime','$JobNumber','$Day','$StudentID')";
    if(mysqli_query($con, $insert))
	{
       //echo $EndTime;
		header("Location: createJobSuccessful.html");
    }
	else
	{
    
		header("Location: createJobFailed.html");
	}
	$con->close();
}
        
	NewJob();
  
?>