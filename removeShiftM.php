<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_NAME', 'dining'); 
define('DB_USER','jeff'); 
define('DB_PASSWORD','jeff');
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error());
$test = $_SESSION['Email'];
$queryID = mysqli_query($con, "SELECT * FROM employee where Email = '$test'") or die(mysql_error());
$rowID = mysqli_fetch_array($queryID);

	if($rowID['EmployeeType']!="Manager") 
        { 
            header("Location: loginPage.html");
			}      
?>

<?php 

$JobNumber = $_POST['JobNumber'];

$addShift_query = "UPDATE schedule SET StudentID='0',FirstName='',Lastname='' WHERE JobNumber = '$JobNumber'";
$addShift_result = mysqli_query($con,$addShift_query);

header("Location: managerssSchedule.php")
?>