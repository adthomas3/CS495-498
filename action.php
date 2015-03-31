<?php 
define('DB_HOST', 'localhost');
define('DB_NAME', 'dining'); 
define('DB_USER','jeff'); 
define('DB_PASSWORD','jeff'); 
    
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
    
$ID = $_POST['user'];
$Password = $_POST['pwd']; 
    
function SignIn() 
{ 
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
    session_start(); //starting the session for user profile page 
    if(!empty($_POST['user'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text 
    { 
        $query = mysqli_query($con, "SELECT * FROM employee where Email = '$_POST[user]' AND Pass = '$_POST[pwd]'") or die(mysql_error()); 
        $row = mysqli_fetch_array($query); 
        
        if(!empty($row['Email']) AND !empty($row['Pass'])) 
        { 
            $_SESSION['Email'] = $row['Email']; 
			
            if($row['EmployeeType'] == "Student"){
					header("Location: student.php");
				}	
			else if($row['EmployeeType'] == "Manager"){
					header("Location: manager.php");
			}
			else if($row['EmployeeType'] == "Director"){
					header("Location: director.php");
			}
				
        } 
        else 
        { 
            header("Location: loginErrorPage.html");
        } 
    } 
}

        SignIn(); 
?>