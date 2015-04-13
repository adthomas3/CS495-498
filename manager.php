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
    <link type="text/css" rel="stylesheet" href="customAndExampleBootstrap/stylesheet.css" />
    <meta charset="utf-8" />
    <title>Welcome!</title>
</head>
<body>
    <ul id="nav">
            <li><a href="manager.html"target="_self">
        Home</a></li>
            <li><a href="requests.php">Requests</a>
                <ul>
                    <li><a href="javascript:window.print()">
                        Print Current Schedule</a></li>
          
                <li><a href="ssSchedule.html" target="_self">
                        View/Change Saturday/Sunday Schedule</a></li> 
                </ul>
    <h2>Here is the Monday-Friday schedeule for your unit:</h2>

                <table width="80%" align="center" >
    <div id="head_nav">
    <tr>
        <th></th>
        <th>Job</th>
        <th>Hours</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thrusday</th>
        <th>Friday</th>
        
    </tr>
</div>  

    <tr>
        <th>1</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>           
                       
        </div>
    </tr>

    <tr>
        <th>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>           

        </div>
    </tr>

    <tr>
        <th>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>          


        </div>
    </tr>

    <tr>
        <th>4</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

        </div>
    </tr>

    <tr>
        <th>5</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>         

        </div>
    </tr>
</table>
</body>
</html>