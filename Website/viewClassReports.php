<?php
//File Name: viewUsers.php
//Purpose: Displays reports pertaining to user information.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 4/13/2014

//start the session
session_start();
?> 

<html>

<head>
	<?php require 'header.php'; ?>
	
	<h1>Welcome to the Rating Report Page</h1>
</head>

<body>

<p>


<?php
require ('../mysqli_connect.php');

$orderBy = "c.classname";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 	if ($_POST['order_by'] == 'class_name'){ 
		////////////For diplaying reports of all users.	////////////////////////////////////////////////////////////////////////////////////////////////////
		$orderBy = "c.classname";
	} else if ($_POST['order_by'] == 'university'){
		////////////For diplaying reports of all users.	////////////////////////////////////////////////////////////////////////////////////////////////////
		$orderBy = "uv.name";
	} else if ($_POST['order_by'] == 'class_id') {
		////////////For diplaying reports of all users.	////////////////////////////////////////////////////////////////////////////////////////////////////
		$orderBy = "c.classid";
	}
}

echo '<form method="post" align="center">Sort by: 
<input type="radio" name="order_by" value="class_name" >Class Name
<input type="radio" name="order_by" value="university" >University
<input type="radio" name="order_by" value="class_id" >Class ID
<input type="submit" value="Sort">
</form>';

$classQuery = "SELECT c.classid, uv.name, c.classname, c.startdate, c.enddate, c.isactive
			   FROM classes c
			   JOIN universities uv ON c.universityid = uv.universityid
               ORDER BY $orderBy
			  "; //WHERE ur.roleid=2
			  
	/* execute multi query */
$result = mysqli_query ($dbc, $classQuery);	
	echo "<table border='1' cellpadding='5' align='center'>";
	echo "<tr bgcolor='9B1321'>
		  	<th>Class ID</th>
			<th>Class Name</th>
			<th>University</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Status</th>
		</tr>";
	
		
	while($row = mysqli_fetch_array($result))
	{
		  echo "<tr>
		  			<td align='center'>" . $row['classid'] . "</td>
					<td>" . $row['classname'] . "</td>
					<td>" . $row['name'] . "</td>
					<td>" . $row['startdate'] . "</td>
					<td>" . $row['enddate'] . "</td>
					<td>"; if ($row['isactive']){
								echo "Active";
							} else {
								echo "Inactive";
							} "</td>
				</tr>";
	}
	echo "</table> <br><br>";
	
mysqli_close($dbc);




?>


</p>


</body>
</html> 