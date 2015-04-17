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

<h2>All open shifts:</h2>
<?php
	$schedule_query = "SELECT * FROM schedule";
	$result = mysqli_query($con, $schedule_query);
	$new_row = array();
		$studentID = $row['StudentID'];
		$query = sprintf("SELECT Job, StartTime, EndTime, Day, JobNumber FROM schedule WHERE StudentID = '0'");
		$schedule_result = mysqli_query($con, $query);
		while ($schedule_row = mysqli_fetch_assoc($schedule_result)){
			$new_row[$studentID][]= array('Job' => $schedule_row['Job'],
								'StartTime' => $schedule_row['StartTime'],
								'EndTime' => $schedule_row['EndTime'],
								'Day' => $schedule_row['Day']);
		}
     ?>
	<?php foreach($new_row as $studentID => $rows):?>
		<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['Job'];?></td>
				<td><?=$row['StartTime'];?></td>
				<td><?=$row['EndTime'];?></td>
				<td><?=$row['Day'];?></td>
				<br>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
   <table width="80%" align="center" >
    <div id="head_nav">
	
<h2>All temp shifts:</h2>
<?php
	$schedule_query = "SELECT * FROM requests";
	$result = mysqli_query($con, $schedule_query);
	$new_row = array();
		$query = sprintf("Select JobNumber FROM requests WHERE StudentID2 NOT IN (0)");
		$schedule_result = mysqli_query($con, $query);
		while ($schedule_row = mysqli_fetch_assoc($schedule_result)){
			$new_row[$studentID][]= array('JobNumber' => $schedule_row['JobNumber']);
		}
     ?>
	<?php foreach($new_row as $studentID2 => $rows):?>
		<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['JobNumber'];?></td>
				<td><form action="" method="POST"> <button name="Approve" class="btn btn-lg btn-primary"  type="submit" value ="">Approve</button></form></td>
				<td><form action="" method="POST"> <button name="Decline" class="btn btn-lg btn-primary"  type="submit" value ="">Decline</button></form></td>
				<br>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
   <table width="80%" align="center" >
    <div id="head_nav">