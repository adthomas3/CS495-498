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
    <link type="text/css" rel="stylesheet" href="customAndExampleBootstrap/stylesheet.css" />
    <meta charset="utf-8" />
    <title>Welcome!</title>
</head>
<body>
    <ul id="nav">
            <li><a href="director.html" target="_self">
                Home</a></li>
            <li><a href="#">Requests</a>
                <ul>
                    <li><a href="createEmployee.html" target="_self">
                        Create New Employee</a></li> 
                    <li><a href="removeEmployee.html" target="_self">
                        Remove Employee</a></li>   
                    <li><a href="" target="_self">
                        View Shift Requests</a></li>    
                    <li><a href="javascript:window.print()">
                        Print Current Schedules</a></li>
                    <li><a href="ssSchedule.html" target="_self">
                        View Saturday/Sunday Schedule</a></li> 
					<li><a href="everyone.html">
                        View All Employees</a></li>
                </ul>
</body>
</html>