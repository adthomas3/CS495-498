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


<html>
<head>
    <link type="text/css" rel="stylesheet" href="stylesheet.css" />
    <meta charset="utf-8" />
    <title>Create Employee</title>
</head>
<body>
	<h1>Students requesting a shifts to be covered</h1>
	
	<?php
	$requests_query = "SELECT * FROM requests";
	$result = mysqli_query($con, $requests_query);
	$new_row = array();
	
	
	
	
	
	
	 foreach($new_row as $requests => $rows):?>
		<?php foreach($rows as $row): ?>
			<tr>
				
				<td><?=$row['StudentID1'];?></td>
				<td><?=$row['JobNumber'];?></td>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
</body>
</html>