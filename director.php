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



<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Welcome!</title>

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
   			<!-- Static navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" style="background-color:black; color:white;">Dining Schedule </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="director.php"target="_self">Home</a></li>
			<li><a href="announcement.php" target="_self">Announcements</a></li>
			<li><a href="createEmployee.html" target="_self">Add Employee</a></li>
			<li><a href="removeEmployee.php" target="_self">Employee Information</a></li>
			<li><a href="CreateJob.html" target="_self">Create Job</a></li>
			<li><a href="delete.php" target="_self">Remove Job</a></li>
            <li><a href="javascript:window.print()">Print</a></li>

          </ul>
         
		  <ul class="nav navbar-nav navbar-right">
            <li class="active"> <a href="logout.php" target="_self">Sign Out<span class="sr-only"></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>



	<h2>Here are the schedules for every unit</h2>


		<table width="40%"  border="1" >
    <div id="head_nav">
	<?php
	$schedule_query = "SELECT * FROM schedule ORDER BY Job ASC";
	$result = mysqli_query($con, $schedule_query);
	$new_row2 = array();
		$studentID = $rowID['StudentID'];
		$Unit = $rowID['Unit'];
		$query2 = sprintf("SELECT Job, StartTime, EndTime, Day, JobNumber, Unit, FirstName, LastName,StudentID FROM schedule 
		WHERE(Day='Monday' OR Day='Tuesday' OR Day='Wednesday' OR Day='Thursday' OR Day='Friday') 
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
						?><form method="POST" action="giveShift.php">
						Input Student ID of the student you wish to have this shift:<br />
						<input type="text" name="StudentIDgiven"></input>
						<button class="btn btn-lg btn-primary"  type="submit" value ="<?php echo $row['JobNumber']?>" name ="JobNumber">Give Shift</button></form><?php 
					else:
						?><form method="POST" action="removeShift.php">
						<button class="btn btn-lg btn-primary"  type="submit" value ="<?php echo $row['JobNumber']?>" name ="JobNumber">Remove shift from student</button></form><?php
					endif;
					?></td>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
      

    </div>


	<p><?php
    $dt = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
    $dt->setTimeZone(new DateTimeZone('America/Indiana/Indianapolis'));
    die($dt->format('M d Y g:i:s a'));
    ?></p>




	<?php 
$Date= date('m');

$f = fopen("01BackupCount.txt", "r");
$DCount1= fgets($f);
fclose($f);

$f = fopen("02BackupCount.txt", "r");
$DCount2= fgets($f);
fclose($f);

$f = fopen("03BackupCount.txt", "r");
$DCount3= fgets($f);
fclose($f);

$f = fopen("04BackupCount.txt", "r");
$DCount4= fgets($f);
fclose($f);

$f = fopen("05BackupCount.txt", "r");
$DCount5= fgets($f);
fclose($f);

$f = fopen("06BackupCount.txt", "r");
$DCount6= fgets($f);
fclose($f);

$f = fopen("07BackupCount.txt", "r");
$DCount7= fgets($f);
fclose($f);

$f = fopen("08BackupCount.txt", "r");
$DCount8= fgets($f);
fclose($f);

$f = fopen("09BackupCount.txt", "r");
$DCount9= fgets($f);
fclose($f);

$f = fopen("10BackupCount.txt", "r");
$DCount10= fgets($f);
fclose($f);

$f = fopen("11BackupCount.txt", "r");
$DCount11= fgets($f);
fclose($f);

$f = fopen("12BackupCount.txt", "r");
$DCount12= fgets($f);
fclose($f);


 if($Date == '01'){ 
	 if ( $DCount1 == '0'){
	 unlink('C:\wamp\www\file02.txt');
	 $f = fopen("01BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("02BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);;
	 }
 }
 
 else if  ($Date == '02'){
	 if ( $DCount2 == '0'){
	 unlink('C:\wamp\www\file03.txt');
	 $f = fopen("02BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("03BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);
	 }
 }
 
	 else if  ($Date == '03'){
	 if ( $DCount3 == '0'){
	 unlink('C:\wamp\www\file04.txt');
	 $f = fopen("03BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("04BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);
	 }
	 }
	 
	 else if  ($Date == '04'){
	 if ( $DCount4 == '0'){
	 unlink('C:\wamp\www\file05.txt');
	 $f = fopen("04BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("05BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);
	 }
	 }
	 
	 else if  ($Date == '05'){
	 if ( $DCount5 == '0'){
	 unlink('C:\wamp\www\file06.txt');
	 $f = fopen("05BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("06BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);
	 }
	 }
	 
	 else if  ($Date == '06'){
	 if ( $DCount6 == '0'){
	 unlink('C:\wamp\www\file07.txt');
	 $f = fopen("06BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("07BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);
	 }
	 }
	 
	 else if  ($Date == '07'){
	 if ( $DCount7 == '0'){
	 unlink('C:\wamp\www\file08.txt');
	 $f = fopen("07BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("08BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);
	 }
	 }
	 
	 else if  ($Date == '08'){
	 if ( $DCount8 == '0'){
	 unlink('C:\wamp\www\file09.txt');
	 $f = fopen("08BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("09BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);
	 }
	 }
	 
	 else if  ($Date == '09'){
	 if ( $DCount9 == '0'){
	 unlink('C:\wamp\www\file10.txt');
	 $f = fopen("09BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("10BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);
	 }
	 }
	 
	 else if  ($Date == '10'){
	 if ( $DCount10 == '0'){
	 unlink('C:\wamp\www\file11.txt');
	 $f = fopen("10BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("11BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);
	 }
	 }
	 
	 else if  ($Date == '11'){
	 if ( $DCount11 == '0'){
	 unlink('C:\wamp\www\file12.txt');
	 $f = fopen("11BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("12BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);
	 }
	 }
	 
	 else if  ($Date == '12'){
	 if ( $DCount12 == '0'){
	 unlink('C:\wamp\www\file01.txt');
	 $f = fopen("12BackupCount.txt", "w");
$txt = "1";
fwrite($f, $txt);
fclose($f);
	 $f = fopen("01BackupCount.txt", "w");
$txt = "0";
fwrite($f, $txt);
fclose($f);
	 }
 }

	 
?> 

</body>
</html>