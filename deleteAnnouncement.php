<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_NAME', 'dining'); 
define('DB_USER','jeff'); 
define('DB_PASSWORD','jeff');

$test = $_SESSION['Email'];
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error());
$queryID = mysqli_query($con, "SELECT * FROM employee where Email = '$test'") or die(mysql_error());
$rowID = mysqli_fetch_array($queryID);


    
    if($rowID['EmployeeType']!="Manager" && $rowID['EmployeeType']!="Director" ) 
        { 
            header("Location: loginPage.html");
            }
			
			
	$Announcement = $_POST['AnnouncementDeleted'];
	
	$remove = "DELETE FROM announcements WHERE Announcement = '$Announcement'";


    if(mysqli_query($con, $remove))
	{
        echo "Announcement Sucessfully Removed";
		header("Location: announcement.php");
    }
	else
	{
		echo "Error: " . $insert . "<br>" . mysqli_error($con);
	}

	$con->close();
	
	?>