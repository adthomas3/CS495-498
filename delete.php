<!DOCTYPE HTML>
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

    <title>Remove Employee</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.3.4/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="customAndExampleBootstrap/navbar-fixed-top.css" rel="stylesheet">
    <link href="customAndExampleBootstrap/customSchedules.css" rel="stylesheet">

    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

  <body>
    
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="director.php"target="_self">Home</a></li>

          </ul>
         
    </nav>

	<h2>All Jobs</h2>
	<?php
	$schedule_query = "SELECT * FROM schedule";
	$result = mysqli_query($con, $schedule_query);
	$new_row = array();
		$StudentID = $rowID['StudentID'];
		$query = sprintf("SELECT JobNumber FROM schedule WHERE JobNumber = '%s'", $test);
		$JobNumber_result = mysqli_query($con, $query);
		$row = mysqli_fetch_row($JobNumber_result);
		$schedule_employee = $row[0]; 
		$query = sprintf("SELECT Unit, Job, StartTime, EndTime, Day, JobNumber FROM schedule ");
		$schedule_result = mysqli_query($con, $query);
		while ($schedule_row = mysqli_fetch_assoc($schedule_result)){
			$new_row[$StudentID][]= array('Unit' => $schedule_row['Unit'],
								'Job' => $schedule_row['Job'],
								'StartTime' => $schedule_row['StartTime'],
								'EndTime' => $schedule_row['EndTime'],
								'JobNumber' => $schedule_row['JobNumber'],
								'Day' => $schedule_row['Day']);
		}
     ?>

	 <table>
	 <div border="1">
      <tr>
        <td> Unit </td>
        <td> Job </td>
        <td> StartTime </td>
        <td> EndTime</td>
        <td> Day </td>
      </tr>
      <?php foreach($new_row as $jobNumber => $rows):?>
      <?php foreach($rows as $row): ?>
      <tr>
        <td><?=$row['Unit'];?></td>
        <td><?=$row['Job'];?></td>
        <td><?=$row['StartTime'];?></td>
        <td><?=$row['EndTime'];?></td>
        <td><?=$row['Day'];?></td>
            <td><form action="deleteJob.php" method="POST"> <button name="JobNumber" class="btn btn-lg btn-primary"  type="submit" value ="<?php echo $row['JobNumber']?>">Remove Job</button></form></td>
			</tr>
      <?php endforeach;?>
      <?php endforeach;?>

    </div>
      </table>



	<p>  <?php
    $dt = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
    $dt->setTimeZone(new DateTimeZone('America/Indiana/Indianapolis'));
    die($dt->format('M d Y g:i:s a'));
    ?></p>
      
      </body>
     </html
