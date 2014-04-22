<?php
//File Name: viewClassReports.php
//Purpose: Displays reports pertaining to user information.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 4/21/2014

//start the session
session_start();
?> 

<html>

<head>
	<?php require 'header.php'; ?>
	
	<h1>Welcome to the Class Report Page</h1>
</head>

<body>

<p>


<?php
require ('../mysqli_connect.php');
$userId = $_SESSION['userid'];
if ($_SESSION['userid']){
 	
	
	$result = mysqli_query($dbc, "SELECT RoleId FROM `users-roles` WHERE UserId = $userId");
	while ($row = mysqli_fetch_array($result)){
		$userRoles[] = $row[0]; 
	}
}

$orderBy = "c.classname";

//Determines sort criteria by class name, university, or class id
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 	if ($_POST['order_by'] == 'class_name'){ 
		$orderBy = "c.classname";
	} else if ($_POST['order_by'] == 'university'){
		$orderBy = "uv.name";
	} else if ($_POST['order_by'] == 'class_id') {
		$orderBy = "c.classid";
	}
}

if (in_array(1, $userRoles)){
	$classQuery = "SELECT c.classid, uv.name, c.classname, c.startdate, c.enddate, c.isactive
			   	   FROM classes c
			       JOIN universities uv ON c.universityid = uv.universityid
                   ORDER BY $orderBy
			      ";
} else if (in_array(2, $userRoles)){
 	$userQuery = "SELECT universityid FROM users WHERE userid=" . $_SESSION['userid'];
	$result = mysqli_query ($dbc, $userQuery);
	while($row = mysqli_fetch_array($result)){
		$userUniversity = $row['universityid'];
	}
	$whereStatement = 'uv.universityid=' . $userUniversity;
 	
	$classQuery = "SELECT c.classid, uv.name, c.classname, c.startdate, c.enddate, c.isactive
			   	   FROM classes c
			       JOIN universities uv ON c.universityid = uv.universityid
			       WHERE $whereStatement
                   ORDER BY $orderBy
			      ";
} if (in_array(3, $userRoles)){
	$classQuery = "SELECT c.classid, uv.name, c.classname, c.startdate, c.enddate, c.isactive
			   	   FROM classes c
			       JOIN universities uv ON c.universityid = uv.universityid
			       JOIN `users-classes` uc ON  uc.classid=c.classid
			       WHERE uc.userid=$userId
                   ORDER BY $orderBy
			      ";
			      
}



echo '<font color="yellow"><form method="post" align="center">Sort by: 
<input type="radio" name="order_by" value="class_name" >Class Name
<input type="radio" name="order_by" value="university" >University
<input type="radio" name="order_by" value="class_id" >Class ID
<input type="submit" value="Sort"></font>
</form>';

			  
	/* execute multi query */
$result = mysqli_query ($dbc, $classQuery);	
	echo "<table border='1' cellpadding='5' align='center' bgcolor='282164'>";
	echo "<tr bgcolor='9B1321'>
		  	<th>Class ID</th>
			<th>Class Name</th>
			<th>University</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Status</th>
			<th>Student Events</th>
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
							} 
						$course=$row['classid'];
			  echo '</td>
					<td><form id="viewClassPosts" method="post" action="searchResults.php">
						<input type="checkbox" name="coursenumber" value="'. $row['classid'] . '">
						<button type="submit" >Submit Change</button>
		   				</form>
					</td>
				</tr>';
	}
	echo "</table> <br><br>";
	
mysqli_close($dbc);




?>


</p>


</body>
</html> 