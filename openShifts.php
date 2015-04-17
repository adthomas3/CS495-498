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
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Open Shifts</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.3.4/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="customAndExampleBootstrap/signin.css" rel="stylesheet">
    <link href="customAndExampleBootstrap/customCreateEmployee.css" rel="stylesheet">

    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

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
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="student.php"target="_self">Home</a></li>

          </ul>
         
		  <ul class="nav navbar-nav navbar-right">
            <li class="active"> </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


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
		$query = sprintf("Select JobNumber FROM requests WHERE StudentID1 NOT IN ($studentID) AND StudentID2 = '0'");
		$schedule_result = mysqli_query($con, $query);
		while ($schedule_row = mysqli_fetch_assoc($schedule_result)){
			$new_row[$studentID][]= array('JobNumber' => $schedule_row['JobNumber']);
		}
     ?>
	<?php foreach($new_row as $studentID2 => $rows):?>
		<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['JobNumber'];?></td>
				<td><form action="requestToCover.php" method="POST"> <button name="JobNumber" class="btn btn-lg btn-primary"  type="submit" value ="<?php echo $row['JobNumber']?>">Request Shift</button></form></td>
				<br>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
   <table width="80%" align="center" >
    <div id="head_nav">


	</body>
</html>