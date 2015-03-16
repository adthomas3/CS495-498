<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'dining'); 
define('DB_USER','jeff'); 
define('DB_PASSWORD','jeff'); 

function removeEmployee()
{
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
    
    $employeeID = $_POST['employeeID'];

    $remove = "DELETE FROM employee WHERE StudentID = '$_POST[employeeID]'";


    if(mysqli_query($con, $remove))
	{
        echo "Employee Sucessfully Removed";
		//header("Location: director.html");
    }
	else
	{
		echo "Error: " . $insert . "<br>" . mysqli_error($con);
	}

	$con->close();
}

        
	removeEmployee();


?>