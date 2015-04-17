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
            <li class="active"><a href="student.php"target="_self">Home</a></li>
            <li><a href="openShifts.php" target="_self">Open Shifts</a></li>
			<li><a href="ssSchedule.php" target="_self">Weekend Schedule</a></li>
			<li><a href="javascript:window.print()">Print</a></li>
          </ul>
         
		  <ul class="nav navbar-nav navbar-right">
            <li class="active"> <a href="logout.php" target="_self">Sign Out<span class="sr-only"></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
			
	<h2>Announcements</h2>
	
	<table width="40%"  border="1"  >
    <div id="head_nav">
	
	<?php 
	$announcements_query = "SELECT * FROM announcements";
	$result = mysqli_query($con, $announcements_query);
	$new_row = array();
		$studentID = $row['StudentID'];
		$Unit_query = "SELECT Unit FROM employee WHERE Email = '$test'";
		$Unit_result = mysqli_query($con, $Unit_query);
		$row = mysqli_fetch_row($Unit_result);
		$Unit_employee = $row[0]; 
		$query = sprintf("SELECT Announcement, Date FROM announcements WHERE Unit = '%s' OR Unit ='All'", $Unit_employee);
		$announcements_result = mysqli_query($con, $query);
		while ($announcements_row = mysqli_fetch_assoc($announcements_result)){
			$new_row[$studentID][]= array('Announcement' => $announcements_row['Announcement'],
								'Date' => $announcements_row['Date']);
		}
		
     ?>
	 
	<?php foreach($new_row as $studentID => $rows):?>
		<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['Date'];?></td>
				<td><?=$row['Announcement'];?></td>
				<br>
			</tr>
		<?php endforeach;?>
	<?php endforeach;  ?>
	
	</div>
	</table>
    <h2>Here is the schedule for your unit:</h2>

	<?php
    
    $Unit_query = "SELECT Unit FROM employee WHERE Email = '$test'";
   	 $Unit_result = mysqli_query($con, $Unit_query);
   	 $row = mysqli_fetch_row($Unit_result);
   	 $Unit_employee = $row[0];
    
switch ($Unit_employee) {
   case 'Atrium':
   	  $logo = 'images/atriumlogo.gif';
     	break;
   case 'Elliot':
     	$logo = 'images/elliott.gif';
     	break;
   case 'LaFollette':
     	$logo = 'images/lafollettelogo.gif';
     	break;
    case 'Noyer':
     	$logo = 'images/noyerlogocolor.gif';
     	break;
    case 'Quiznos':
     	$logo = 'QuiznosSSS_oval.eps';
     	break;
    case 'Retreat':
     	$logo = 'retreatlogocolor.gif';
     	break;
    case 'Tally':
     	$logo = 'studentcentertally.gif';
     	break;
    case 'BookMark':
     	$logo = 'bookmarklogo.gif';
     	break;
    case 'TomJohn':
     	$logo = 'tomjohn.gif';
     	break;
    case 'WoodWorth':
     	$logo = 'woodworthcommonslogo.gif';
     	break;
    case 'Burris':
     	$logo = 'burrislogo.gif';
     	break;
}

?> <img src = "<?php echo $logo ?>" alt = "test"/>
	

	<table width="40%"  border="1" >
    <div id="head_nav">
	
	<?php
	$schedule_query = "SELECT * FROM schedule ORDER BY Job ASC";
	$result = mysqli_query($con, $schedule_query);
	$new_row2 = array();
		$query2 = sprintf("SELECT Job, StartTime, EndTime, Day, JobNumber FROM schedule WHERE StudentID = '%s'", $studentID);
		$schedule_result = mysqli_query($con, $query2);
		while ($schedule_row = mysqli_fetch_assoc($schedule_result)){
			$new_row2[$studentID][]= array('Job' => $schedule_row['Job'],
								'StartTime' => $schedule_row['StartTime'],
								'EndTime' => $schedule_row['EndTime'],
								'Day' => $schedule_row['Day'],
								'JobNumber' => $schedule_row['JobNumber']);
		}
     ?>
	 
	<?php foreach($new_row2 as $studentID => $rows):?>
			<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['Job'];?></td>
				<td><?=$row['StartTime'];?></td>
				<td><?=$row['EndTime'];?></td>
				<td><?=$row['Day'];?></td>
				<td><form action="requestoff.php" method="POST"> <button name="JobNumber" class="btn btn-lg btn-primary"  type="submit" value ="<?php echo $row['JobNumber']?>">Request Shift off</button></form></td>
				<br>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
      

    </div>
</table>
</body>
</html>