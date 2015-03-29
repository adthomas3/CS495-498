<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link type="text/css" rel="stylesheet" href="stylesheet.css" />
    <meta charset="utf-8" />
    <title>Create Employee</title>
</head>
<body>
    
	<h1>Students requesting more shifts</h1>
	
	<?php
	$requests_query = "SELECT * FROM requests WHERE RequestType = 'add'";
	$result = mysqli_query($sql_link, $requests_query);
	$new_row = array();
	
	
	<?php foreach($new_row as $requests => $rows):?>
		<?php foreach)$rows as $row): ?>
			<tr>
				<td><?=$requests;?></td>
				<td><?=$row['StudentID1'];?></td>
				<td><?=$row['JobID'];?></td>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
	
	<h1>Students requesting a shifts to be covered</h1>
	
	<?php
	$requests_query = "SELECT * FROM requests WHERE RequestType = 'drop'";
	$result = mysqli_query($sql_link, $requests_query);
	$new_row = array();
	
	
	<?php foreach($new_row as $requests => $rows):?>
		<?php foreach)$rows as $row): ?>
			<tr>
				<td><?=$requests;?></td>
				<td><?=$row['StudentID1'];?></td>
				<td><?=$row['JobID'];?></td>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
	
	<h1>Students requesting to trade shifts</h1>
        
		<?php
	$requests_query = "SELECT * FROM requests WHERE RequestType = 'trade'";
	$result = mysqli_query($sql_link, $requests_query);
	$new_row = array();
	
	
	<?php foreach($new_row as $requests => $rows):?>
		<?php foreach)$rows as $row): ?>
			<tr>
				<td><?=$requests;?></td>
				<td><?=$row['StudentID1'];?></td>
				<td><?=$row['StudentID2'];?></td>
				<td><?=$row['JobID'];?></td>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
	
        

</body>
</html>