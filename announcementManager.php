<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link type="text/css" rel="stylesheet" href="stylesheet.css" />
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
                        View/Change Saturday/Sunday Schedule</a></li>    
                </ul>
    
	
	
	<form method="POST" action="createAnnouncementManager.php">
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
</table>
</body>
</html>