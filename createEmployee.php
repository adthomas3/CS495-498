<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'dining'); 
define('DB_USER','jeff'); 
define('DB_PASSWORD','jeff'); 
    
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
//$studentID = $_POST['studentID'];
//$password = $_POST['password'];
function NewUser()
{
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $studentID = $_POST['studentID'];
    $employeeType = $_POST['employeeType'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $unit = $_POST['unit'];
    $insert = "INSERT INTO employee (FirstName, LastName, StudentID, EmployeeType, PhoneNumber, Email, Address, Pass, Unit)
              VALUES
              ('$firstName','$lastName','$studentID','$employeeType','$phoneNumber','$email',
				'$address','$password','$unit')";
    if(mysqli_query($con, $insert))
	{
       // echo "Employee Sucessfully Registered";
		header("Location: createEmployeeSuccessful.html");
    }
	else
	{
    
		header("Location: createEmployeeFailed.html");
	}
	$con->close();
}
        
	NewUser();
  
?>