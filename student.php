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

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link type="text/css" rel="stylesheet" href="stylesheet.css" />
    <meta charset="utf-8" />
    <title>Welcome!</title>
</head>
<body>
    <ul id="nav">
            <li><a href="student.html"target="_self">
        Home</a></li>
            <li><a href="#">Requests</a>
                <ul>
                    <li><a href="" target="_blank">
                        Request Shift Trade</a></li> 
                    <li><a href="" target="_blank">
                        Request Shift Drop</a></li>   
                    <li><a href="javascript:window.print()">
                        Print Current Schedule</a></li>
                    <li><a href="ssSchedule.html" target="_self">
                        View/Make Requests Saturday/Sunday Schedule</a></li>
                </ul>
    <h2>Here is the schedule for your unit:</h2>

	<?php
	$schedule_query = "SELECT * FROM schedule";
	$result = mysqli_query($con, $schedule_query);
	$new_row = array();
		$studentID = $row['StudentID'];
		$query = sprintf("SELECT Job, Hours, Day, JobNumber FROM schedule WHERE StudentID = '%s'", $row['StudentID']);
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
				<td><form action="requestoff.php" method="POST"> <input type="submit" value="Request shift off"> </form></td>
				<br>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
      
   <table width="80%" align="center" >
    <div id="head_nav">
    
</table>
</body>
</html>