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
	if($rowID['EmployeeType']!="Student") 
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
		$query = sprintf("SELECT Job, Hours, Day, JobNumber FROM schedule WHERE StudentID = '0'");
		$schedule_result = mysqli_query($con, $query);
		while ($schedule_row = mysqli_fetch_assoc($schedule_result)){
			$new_row[$studentID][]= array('Job' => $schedule_row['Job'],
								'Hours' => $schedule_row['Hours'],
								'Day' => $schedule_row['Day']);
		}
     ?>
	<?php foreach($new_row as $studentID => $rows):?>
		<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['Job'];?></td>
				<td><?=$row['Hours'];?></td>
				<td><?=$row['Day'];?></td>
				<br>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
   <table width="80%" align="center" >
    <div id="head_nav">
	
<h2>All temp shifts:</h2>
<?php
	$tempShift_query = "SELECT * FROM requests";
	$result = mysqli_query($con, $tempShift_query);
	$new_row = array();
		$query = sprintf("SELECT JobNumber FROM requests");
		$tempShift_result = mysqli_query($con, $query);
		$row = mysqli_fetch_row($tempShift_result);
		$test = $row[0];
	$info_query = "SELECT * FROM schedule";
	$result = mysqli_query($con, $info_query);
	$new_row = array();
		$query = sprintf("SELECT Job, Hours, Day FROM schedule where JobNumber = $test");
		$info_result = mysqli_query($con, $query);
		$row = mysqli_fetch_row($info_result);
		
		while ($schedule_row = mysqli_fetch_assoc($info_result)){
			$new_row[$studentID][]= array('Job' => $schedule_row['Job'],
								'Hours' => $schedule_row['Hours'],
								'Day' => $schedule_row['Day']);
		}
		?>
		<?php foreach($new_row as $studentID => $rows):?>
		<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['Job'];?></td>
				<td><?=$row['Hours'];?></td>
				<td><?=$row['Day'];?></td>
				<br>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
   <table width="80%" align="center" >
    <div id="head_nav">