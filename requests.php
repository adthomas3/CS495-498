<!DOCTYPE html>
<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_NAME', 'dining'); 
define('DB_USER','jeff'); 
define('DB_PASSWORD','jeff');
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error());
$test = $_SESSION['Email'];
$query = mysqli_query($con, "SELECT * FROM employee where Email = '$test'") or die(mysql_error());
$row = mysqli_fetch_array($query);

$queryID = mysqli_query($con, "SELECT * FROM employee where Email = '$test'") or die(mysql_error());
$rowID = mysqli_fetch_array($queryID);


	
	if($rowID['EmployeeType']!="Manager") 
        { 
            header("Location: loginPage.html");
			}      
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link type="text/css" rel="stylesheet" href="stylesheet.css" />
    <meta charset="utf-8" />
    <title>Requests</title>
</head>
<body>
    
	<h1>Students requesting more shifts</h1>
	
	<?php
	$requests_query = "SELECT * FROM requests";
	$result = mysqli_query($con, $requests_query);
	$new_row = array();
		$studentID = $row['StudentID'];
		$query2 = sprintf("SELECT StudentID1, JobID FROM requests WHERE RequestType = 'Add'");
		$requests_result = mysqli_query($con, $query2);
		while ($requests_row = mysqli_fetch_assoc($requests_result)){
			$new_row[$studentID][]= array('StudentID1' => $requests_row['StudentID1'],
								'JobID' => $requests_row['JobID']);
		}
     ?>
	<table>
	
	<?php foreach($new_row as $requests => $rows):?>
		<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['StudentID1'];?></td>
				<td><?=$row['JobID'];?></td>
				<td><form action="acceptAddRequest.php" method="POST"> <input type="submit" value="Accept add request"> </form></td>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
	
	</table>
	
	<h1>Students requesting a shifts to be covered</h1>
	
	<?php
	$requests_query = "SELECT * FROM requests";
	$result = mysqli_query($con, $requests_query);
	$new_row = array();
		$query2 = sprintf("SELECT StudentID1, JobID FROM requests WHERE RequestType = 'Drop'");
		$requests_result = mysqli_query($con, $query2);
		while ($requests_row = mysqli_fetch_assoc($requests_result)){
			$new_row[$studentID][]= array('StudentID1' => $requests_row['StudentID1'],
								'JobID' => $requests_row['JobID']);
		}
     ?>
	<table>
	
	<?php foreach($new_row as $requests => $rows):?>
		<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['StudentID1'];?></td>
				<td><?=$row['JobID'];?></td>
				<td><form action="acceptDropRequest.php" method="POST"> <input type="submit" value="Accept drop request"> </form></td>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
	
	</table>		
        

</body>
</html>