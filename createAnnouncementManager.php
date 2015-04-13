<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'dining'); 
define('DB_USER','jeff'); 
define('DB_PASSWORD','jeff'); 
    
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 



	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
    $Unit = $_POST['Unit'];
    $Announcement = $_POST['Announcement'];
    $Date = $_POST['Date'];
    $insert = "INSERT INTO announcements (Unit, Announcement, Date)
              VALUES
              ('$Unit','$Announcement','$Date')";


    if(mysqli_query($con, $insert))
	{
        echo "Announcement Sent";
    }
	else
	{
		echo "Error: " . $insert . "<br>" . mysqli_error($con);
	}
?>
	<form action="manager.php" method="POST">
	<input type="submit" value="Go back to Manager page">
	</form>
<?php
	$con->close();

	

  
?>