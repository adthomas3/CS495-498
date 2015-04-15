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
    <link href="customAndExampleBootstrap/signin.css" rel="stylesheet">
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
         
		  <ul class="nav navbar-nav navbar-right">
            <li class="active"> </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


	
	<table width="40%"  border="1" >
    <div id="head_nav">

      <?php
	$employee_query = "SELECT * FROM employee";
	$result = mysqli_query($con, $employee_query);
	$new_row = array();
		$studentID = $rowID['StudentID'];
		$query = sprintf("SELECT Unit FROM employee WHERE Email = '%s'", $test);
		$Unit_result = mysqli_query($con, $query);
		$row = mysqli_fetch_row($Unit_result);
		$Unit_employee = $row[0]; 
		$query = sprintf("SELECT FirstName, LastName, StudentID, EmployeeType, PhoneNumber, Email, Address FROM employee ");
		$employees_result = mysqli_query($con, $query);
		while ($employee_row = mysqli_fetch_assoc($employees_result)){
			$new_row[$studentID][]= array('FirstName' => $employee_row['FirstName'],
								'LastName' => $employee_row['LastName'],
								'StudentID' => $employee_row['StudentID'],
								'EmployeeType' => $employee_row['EmployeeType'],
								'PhoneNumber' => $employee_row['PhoneNumber'],
								'Email' => $employee_row['Email'],
								'Address' => $employee_row['Address']);
		}
     ?>
      <tr>
        <td> First Name </td>
        <td> Last Name </td>
        <td> Employee ID </td>
        <td> Employee Type</td>
        <td> Phone Number </td>
        <td> Email </td>
        <td> Address </td>
      </tr>
      <?php foreach($new_row as $studentID => $rows):?>
      <?php foreach($rows as $row): ?>
      <tr>
        <td>
          <?=$row['FirstName'];?>
        </td>
        <td>
          <?=$row['LastName'];?>
        </td>
        <td>
          <?=$row['StudentID'];?>
        </td>
        <td>
          <?=$row['EmployeeType'];?>
        </td>
        <td>
          <?=$row['PhoneNumber'];?>
        </td>
        <td>
          <?=$row['Email'];?>
        </td>
        <td>
          <?=$row['Address'];?>
        </td>
            <td><form action="remove.php" method="POST"> <button name="StudentID" class="btn btn-lg btn-primary"  type="submit" value ="<?php echo $row['StudentID']?>">Remove Employee</button></form></td>
        <br>
			</tr>
      <?php endforeach;?>
      <?php endforeach;?>

    </div>
      </table>
      
      </body>
     </html
