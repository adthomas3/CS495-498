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
			<li><a href="createEmployee.html" target="_self">Add Employee</a></li>
			<li><a href="CreateJob.html" target="_self">Create Job</a></li>
			<li><a href="removeEmployee.php" target="_self">Employee Information</a></li>

			<li><a href=".php" target="_self">View Shift Records</a></li>

            <li><a href="javascript:window.print()">Print</a></li>

          </ul>
         
		  <ul class="nav navbar-nav navbar-right">
            <li class="active"> <a href="logout.php" target="_self">Sign Out<span class="sr-only"></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>



	<h2>Here are the schedules for every unit</h2>

	<p> don't forget to pull image </p>


	<table width="40%"  border="1" >
    <div id="head_nav">

      <?php
	$schedule_query = "SELECT * FROM schedule";
	$result = mysqli_query($con, $schedule_query);
	$new_row = array();
		$studentID = $rowID['StudentID']; 
		$query = sprintf("SELECT Unit, Job, Hours, Day, JobNumber, StudentID FROM schedule ");
		$schedule = mysqli_query($con, $query);
		while ($schedule_row = mysqli_fetch_assoc($schedule)){
			$new_row[$studentID][]= array('Unit' => $schedule_row['Unit'],
								'Job' => $schedule_row['Job'],
								'Hours' => $schedule_row['Hours'],
								'Day' => $schedule_row['Day'],
								'JobNumber' => $schedule_row['JobNumber'],
								'StudentID' => $schedule_row['StudentID']);
		}
     ?>
      <tr>
        <td> Unit </td>
        <td> Job </td>
        <td> Hours </td>
        <td> Day </td>
        <td> Job Number </td>
        <td> Student ID </td>
      </tr>
      <?php foreach($new_row as $studentID => $rows):?>
      <?php foreach($rows as $row): ?>
      <tr>
        <td>
          <?=$row['Unit'];?>
        </td>
        <td>
          <?=$row['Job'];?>
        </td>
        <td>
          <?=$row['Hours'];?>
        </td>
        <td>
          <?=$row['Day'];?>
        </td>
        <td>
          <?=$row['JobNumber'];?>
        </td>
        <td>
          <?=$row['StudentID'];?>
        </td>

        <br>
			</tr>
      <?php endforeach;?>
      <?php endforeach;?>

    </div>
      </table>



</body>
</html>