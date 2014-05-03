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
//DB connection file
require ('../mysqli_connect.php');

//get users id from session variable
$userId = $_SESSION['userid'];
//get role of user
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

///If site admin
if (in_array(1, $userRoles)){//show all courses
	$classQuery = "SELECT u.firstname, u.middleinitial, u.lastname, u.email, c.classid, uv.name, c.classname, c.startdate, c.enddate, c.isactive
			   	   FROM classes c
			       JOIN universities uv ON c.universityid = uv.universityid
			       JOIN `users-classes` uc ON  uc.classid = c.classid
			       JOIN  users u ON  u.userid = uc.userid
			       JOIN `users-roles` ur ON  ur.userid = u.userid
			       WHERE ur.roleid = 3
                   ORDER BY $orderBy
			      ";
//If univeristy admin			      
} else if (in_array(2, $userRoles)){//show all courses in my university
 	$userQuery = "SELECT universityid FROM users WHERE userid=" . $_SESSION['userid'];
	$result = mysqli_query ($dbc, $userQuery);
	while($row = mysqli_fetch_array($result)){
		$userUniversity = $row['universityid'];
	}
	$whereStatement = 'uv.universityid=' . $userUniversity;
 	
	$classQuery = "SELECT u.firstname, u.middleinitial, u.lastname, u.email, c.classid, uv.name, c.classname, c.startdate, c.enddate, c.isactive
			   	   FROM classes c
			       JOIN universities uv ON c.universityid = uv.universityid
			       JOIN `users-classes` uc ON  uc.classid = c.classid
			       JOIN  users u ON  u.userid = uc.userid
			       JOIN `users-roles` ur ON  ur.userid = u.userid
			       WHERE ur.roleid = 3 AND $whereStatement
                   ORDER BY $orderBy
			      ";
//if I am a professor			      
} if (in_array(3, $userRoles)){//show all courses where I am a professor
	$classQuery = "SELECT u.firstname, u.middleinitial, u.lastname, u.email, c.classid, uv.name, c.classname, c.startdate, c.enddate, c.isactive
			   	   FROM classes c
			       JOIN universities uv ON c.universityid = uv.universityid
			       JOIN `users-classes` uc ON  uc.classid = c.classid
			       JOIN  users u ON  u.userid = uc.userid
			       JOIN `users-roles` ur ON  ur.userid = u.userid
			       WHERE ur.roleid = 3 AND uc.userid = $userId
                   ORDER BY $orderBy";
			      
}

//display sorting form
echo '<center><font color="yellow"><form id="reportsform" method="post" align="center">Sort by: 
<input type="radio" name="order_by" value="class_name" >Class Name
<input type="radio" name="order_by" value="university" >University
<input type="radio" name="order_by" value="class_id" >Class ID
<input type="submit" value="Sort"></font>
</form></center>';

			  
	/* execute multi query */
$result = mysqli_query ($dbc, $classQuery);	
	echo "<table border='1' cellpadding='5' align='center' bgcolor='282164'>";
	echo "<tr bgcolor='9B1321'>
		  	<th>Class ID</th>
			<th>Class Name</th>
			<th>University</th>
			<th>Professor</th>
			<th>Email</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Status</th>
			<th>Student Events</th>
		</tr>";
	
		//display query rows
	while($row = mysqli_fetch_array($result))
	{
		  echo "<tr>
		  			<td align='center'>" . $row['classid'] . "</td>
					<td>" . $row['classname'] . "</td>
					<td>" . $row['name'] . "</td>
					<td>" . $row['lastname'] . ", ".$row['firstname'] . $row['middleinitial'] .".</td>
					<td>" . $row['email'] . "</td>
					<td>" . $row['startdate'] . "</td>
					<td>" . $row['enddate'] . "</td>
					<td>"; if ($row['isactive']){
								echo "Active";
							} else {
								echo "Inactive";
							} 
			  echo '</td>
					<td><form id="viewClassPosts" method="post" action="searchResults.php">
							<button type="submit"  name="coursenumber" value="'. $row['classid'] . '">View Class Events</button>
		   				</form>
					</td>
				</tr>';
	}
	echo "</table> <br><br>";
	
//close DB connection	
mysqli_close($dbc);




?>


</p>


</body>
</html> 
