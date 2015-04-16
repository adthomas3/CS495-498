<!DOCTYPE html>

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
$row = mysqli_fetch_array($queryID);


    
    if($rowID['EmployeeType']!="Manager" && $rowID['EmployeeType']!="Director" ) 
        { 
            header("Location: loginPage.html");
            }
    
	if($rowID['EmployeeType']=='Manager') {
	$EmployeeType = 'manager';
	}
	else if($rowID['EmployeeType']=='Director'){
	$EmployeeType = 'director';
	}
            
        
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Make Announcments</title>

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

	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo $EmployeeType ?>.php"target="_self">Home</a></li>

          </ul>
         
		  <ul class="nav navbar-nav navbar-right">
            <li class="active"> </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<form method="POST" action="createAnnouncement.php">
        <fieldset>
        <legend>Make announcements here</legend>
		Where is the announcement going?
		<br>
         <select name ="Unit">
			<option value="All">All</option>
			<option value="Noyer">Noyer Centre</option>
			<option value="Atrium">Atrium</option>
			<option value="LaFollette">LaFollette</option>
			<option value="Elliott">Elliot</option>
			<option value="Woodworth">Woodworth</option>
			<option value="BookmarkCafe">Bookmark Cafe</option>
			<option value="StudentCenter">Student Center</option>
			<option value="Quiznos">Quiznos</option>
			<option value="Retreat">Retreat</option>
			<option value="TomJohn">Tom John</option>
			<option value="Burris">Burris</option>
		</select> 
        <br><br>
        Announcement:<br>
        <input type="text" name="Announcement">
        <br>
        Date(as m/d/y):<br>
        <input type="text" name="Date">
        <br>
        
        
        <input type="submit" name ="submit" value="Submit"></fieldset>
        </form>
		
		<h2>Announcements</h2>
	
	<table width="40%"  border="1"  >
    <div id="head_nav">
	
	<?php 
	
	$announcements_query = "SELECT * FROM announcements";
	$result = mysqli_query($con, $announcements_query);
	$new_row = array();
		$studentID = $rowID['StudentID'];
		$Unit_query = "SELECT Unit FROM employee WHERE Email = '$test'";
		$Unit_result = mysqli_query($con, $Unit_query);
		$row = mysqli_fetch_row($Unit_result);
		$Unit_employee = $row[0]; 
		$query = sprintf("SELECT Unit, Announcement, Date FROM announcements WHERE Unit = '%s' OR Unit = 'All'", $Unit_employee);
		$announcements_result = mysqli_query($con, $query);
		while ($announcements_row = mysqli_fetch_assoc($announcements_result)){
			$new_row[$studentID][]= array('Announcement' => $announcements_row['Announcement'],
								'Date' => $announcements_row['Date'],
								'Unit' => $announcements_row['Unit']);
		}
		
     ?>
	 
			<tr>
				<td> Unit </td>
				<td> Date of Announcement </td>
				<td> Announcement </td>
			<tr>
	 
	<?php foreach($new_row as $studentID => $rows):?>
		<?php foreach($rows as $row): ?>
			<tr>
				<td><?=$row['Unit'];?></td>
				<td><?=$row['Date'];?></td>
				<td><?=$row['Announcement'];?></td>
				<td><form action="deleteAnnouncement.php" method="POST"> <button name = "AnnouncementDeleted" type="submit" value="<?php echo $row['Announcement']?>">Delete Announcement</button></form></td>
				<br>
			</tr>
		<?php endforeach;?>
	<?php endforeach;  ?>
	
	</div>
	</table>
</table>
</body>
</html>