﻿<?php
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
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Weekend Schedule</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.3.4/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="customAndExampleBootstrap/navbar-fixed-top.css" rel="stylesheet">
    <link href="customAndExampleBootstrap/customSchedules.css" rel="stylesheet">

    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <ul id="nav">
  
            
            
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active">
              <a href="manager.php"target="_self">Home</a>
            </li>

            <li>
              <a href="javascript:window.print()">Print</a>
            </li>
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>

    
    <h2>Here is the Weekend schedule for your unit</h2>
		<table width="40%"  border="1" >
    <div id="head_nav">
	<?php
	$schedule_query = "SELECT Unit FROM employee WHERE email = '$test'";
	$result = mysqli_query($con, $schedule_query);
	$new_row2 = array();
		$studentID = $rowID['StudentID'];
		$Unit = $rowID['Unit'];
		$query2 = sprintf("SELECT Job, StartTime, EndTime, Day, JobNumber, Unit, FirstName, LastName, StudentID FROM schedule 
		WHERE(Day='Saturday-1' OR Day='Saturday-2' OR Day='Sunday-1' OR Day='Sunday-2') 
		ORDER BY UNIT ASC,
		CASE Day
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
								'LastName' => $schedule_row['LastName'],
								'StudentID' => $schedule_row['StudentID']);
		}
     ?>
			<tr> 
				<td> Unit </td>
				<td> Job </td>
				<td> Start Time </td>
				<td> End Time </td>
				<td> Day </td>
				<td> Name </td>
	 
	<?php foreach($new_row2 as $studentID => $rows):?>
			<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['Unit'];?></td>
				<td><?=$row['Job'];?></td>
				<td><?=$row['StartTime'];?></td>
				<td><?=$row['EndTime'];?></td>
				<td><?=$row['Day'];?></td>
				<td><?=$row['FirstName'];?><br><?=$row['LastName'];?></td>
				<td><?php 
				if($row['StudentID']==0):
						?><form method="POST" action="giveShiftM.php">
						Input Student ID of the student you wish to have this shift:<br />
						<input type="text" name="StudentIDgiven"></input>
						<button class="btn btn-lg btn-primary"  type="submit" value ="<?php echo $row['JobNumber']?>" name ="JobNumber">Give Shift</button></form><?php 
					else:
						?><form method="POST" action="removeShiftM.php">
						<button class="btn btn-lg btn-primary"  type="submit" value ="<?php echo $row['JobNumber']?>" name ="JobNumber">Remove shift from student</button></form><?php
					endif;
					?></td>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
      

    </div>

	</table>

	<p><?php
    $dt = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
    $dt->setTimeZone(new DateTimeZone('America/Indiana/Indianapolis'));
    die($dt->format('M d Y g:i:s a'));
    ?></p>


</body>
</html>