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

	if($rowID['EmployeeType']!="Director") 
        { 
            header("Location: loginPage.html");
			}      
?>

<table width="40%"  border="1" >
<div id="head_nav">
	<?php
	$schedule_query = "SELECT * FROM schedule ORDER BY Job ASC";
	$result = mysqli_query($con, $schedule_query);
	$new_row2 = array();
		$studentID = $rowID['StudentID'];
		$Unit = $rowID['Unit'];
		$query2 = sprintf("SELECT Job, StartTime, EndTime, Day, JobNumber, Unit, FirstName, LastName FROM schedule 
		WHERE(Day='Sunday' OR Day='Saturday') 
		ORDER BY CASE Day
					WHEN 'Sunday' THEN 1
					WHEN 'Monday' THEN 2
					WHEN 'Tuesday' THEN 3
					WHEN 'Wednesday' THEN 4
					WHEN 'Thursday' THEN 5
					WHEN 'Friday' THEN 6
					WHEN 'Saturday' THEN 7
					ELSE NULL
					END ASC, StartTime ASC");
		$schedule_result = mysqli_query($con, $query2);
		while ($schedule_row = mysqli_fetch_assoc($schedule_result)){
			$new_row2[$studentID][]= array('Job' => $schedule_row['Job'],
								'StartTime' => $schedule_row['StartTime'],
								'EndTime' => $schedule_row['EndTime'],
								'Day' => $schedule_row['Day'],
								'JobNumber' => $schedule_row['JobNumber'],
								'Unit' => $schedule_row['Unit'],
								'FirstName' => $schedule_row['FirstName'],
								'LastName' => $schedule_row['LastName']);
		}
     ?>
			<tr> 
				<td> Unit </td>
				<td> Job </td>
				<td> Start Time </td>
				<td> End Time </td>
				<td> Day </td>
				<td> First Name </td>
				<td> Last Name </td>
	 
	<?php foreach($new_row2 as $studentID => $rows):?>
			<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['Unit'];?></td>
				<td><?=$row['Job'];?></td>
				<td><?=$row['StartTime'];?></td>
				<td><?=$row['EndTime'];?></td>
				<td><?=$row['Day'];?></td>
				<td><?=$row['FirstName'];?></td>
				<td><?=$row['LastName'];?></td>
				<br>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
      

    </div>