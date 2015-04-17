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
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <!--<link type="text/css" rel="stylesheet" href="stylesheet.css" /> -->
    <title>Welcome!</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <ul id="nav">
        <!-- If director, go to director.html, if student, go to student.html, if manager, go to mangager.html --> 
         <!-- Options will vary based on employee type.... or create separate html pages for respective users... not real sure yet... may have to redo everything 
             student will have to make requests --> 
            
            <li><a href="manager.php" target="_self">Home</a></li>
            <li><a href="#">Requests</a>
                <ul>
                    <li><a href="javascript:window.print()">
                        Print Current Schedule(s)</a></li>
                    <li><a href="" target="_self">
                        View Shift Requests</a></li> 
        <!-- If director, show all units -->      
    <h2>Here is the Saturday/Sunday schedeule</h2>

		<table width="40%"  border="1" >
    <div id="head_nav">

	<?php
	$schedule_query = "SELECT * FROM schedule ORDER BY Job ASC";
	$result = mysqli_query($con, $schedule_query);
	$new_row2 = array();
		$studentID = $rowID['StudentID'];
		$Unit = $rowID['Unit'];
		$query2 = sprintf("SELECT Job, StartTime, EndTime, Day, JobNumber, Unit, FirstName, LastName FROM schedule WHERE
					Day='Saturday' OR Day='Sunday'");
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
</body>
</html>