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


    
    if($rowID['EmployeeType']!="Manager" && $rowID['EmployeeType']!="Director" ) 
        { 
            header("Location: loginPage.html");
            }
     
    $Unit = $_POST['Unit'];
    $Announcement = $_POST['Announcement'];
    $Date = $_POST['Date'];
    $insert = "INSERT INTO announcements (Unit, Announcement, Date)
              VALUES
              ('$Unit','$Announcement','$Date')";


    if(mysqli_query($con, $insert))
	{
       header("Location: announcement.php");
    }
	else
	{
		echo "Error: " . $insert . "<br>" . mysqli_error($con);
	}
	

?>
<?php
	$con->close();

	

  
?>