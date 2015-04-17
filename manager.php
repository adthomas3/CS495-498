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
            <li class="active"><a href="manager.php"target="_self">Home</a></li>
			<li><a href="announcement.php" target="_self">Announcements</a></li>
			<li><a href="allRequests.php" target="_self">Requests</a></li>
			<li><a href="ssSchedule.php" target="_self">Weekend Schedules</a></li>
			<li><a href="javascript:window.print()">Print</a></li>
          </ul>
         
		  <ul class="nav navbar-nav navbar-right">
            <li class="active"> <a href="logout.php" target="_self">Sign Out<span class="sr-only"></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
				
    <h2>Here is the Monday-Friday schedeule for your unit:</h2>
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
		$studentID = $rowID['StudentID'];
		$Unit = $rowID['Unit'];
		$query2 = sprintf("SELECT Job, StartTime, EndTime, Day, JobNumber, Unit, FirstName, LastName FROM schedule WHERE Unit = '%s'
					AND (Day='Monday' OR Day='Tuesday' OR Day='Wednesday' OR Day='Thursday' OR Day='Friday')", $Unit);
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