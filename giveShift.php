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

	if($rowID['EmployeeType']!="Director") 
        { 
            header("Location: loginPage.html");
			}      
?>

<?php 

$studentID = $_POST['StudentIDgiven'];
$JobNumber = $_POST['JobNumber'];

$ScheduleQuery = sprintf("SELECT FirstName, LastName FROM employee Where StudentID = '%s'", $studentID);
$QueryResult = mysqli_query($con, $ScheduleQuery);
$row2 = mysqli_fetch_array($QueryResult);
$employeeFirst = $row2['FirstName'];
$employeeLast = $row2['LastName'];
echo $employeeFirst;
echo $employeeLast;
echo $studentID;
echo $JobNumber;
$addShift_query = "UPDATE schedule SET StudentID='$studentID',FirstName='$employeeFirst',Lastname='$employeeLast' WHERE JobNumber = '$JobNumber'";
$addShift_result = mysqli_query($con,$addShift_query);

header("Location: director.php")


	
?>	
		