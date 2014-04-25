<?php
//File Name: viewUsers.php
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
	
	<h1>Welcome to the User Report Page</h1>
</head>

<body>

<p>


<?php
require ('../mysqli_connect.php');
$userRoles = array();

// Check what roles a user has
if ($_SESSION['userid']){
 	
	$userId = $_SESSION['userid'];
	$result = mysqli_query($dbc, "SELECT RoleId FROM `users-roles` WHERE UserId = $userId");
	while ($row = mysqli_fetch_array($result)){
		$userRoles[] = $row[0]; 
	}
}

//defualt order by criteria
$orderBy = "u.lastname";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 	//determine if user selected sort by role, class, or university
	 if ($_POST['order_by'] == 'last_name'){ 
		$orderBy = "u.lastname";
	} else if ($_POST['order_by'] == 'class'){
		$orderBy = "uc.classid";
	} else if ($_POST['order_by'] == 'university') {
		$orderBy = "uv.name";
	}
}

//Displays radio buttons for sort selection.
echo '<font color="yellow"><b><form id="reportsform" method="post" align="center">Sort by: 
<input type="radio" name="order_by" value="last_name" >Last Name
<input type="radio" name="order_by" value="class" >Class ID
<input type="radio" name="order_by" value="university" >University
<input type="submit" value="Sort"></b></font>
</form>';

////////////For diplaying report of University Administrators.//////////////////////////////////////////////////////////////////////////////////////////
if (in_array(1, $userRoles)){//can be seen only by Site Admin (1)
	
	$userQuery = "
		SELECT u.userid, u.firstname, u.middleinitial, u.lastname, u.email, uv.name, r.rolename, uc.classid, u.username FROM users u
		LEFT JOIN universities uv ON u.universityid = uv.universityid
		LEFT JOIN `users-roles` ur ON u.userid = ur.userid
        LEFT JOIN roles r ON ur.roleid=r.roleid
        LEFT JOIN `users-classes` uc ON u.userid = uc.userid
        WHERE ur.roleid=2
        ORDER BY $orderBy "; ////ur.roleid=2 signifies University Admin

	// execute query 
	$result = mysqli_query ($dbc, $userQuery);	
	
	//Display headings
	echo "<h1>Univeristy Administrators</h1>";
	echo "<table border='1' cellpadding='5' align='center' bgcolor='282164'>";
	echo "<tr bgcolor='9B1321'>
		  	<th>User ID</th>
			<th>Full Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>University</th>
			<th>Role</th>
			<th>Class</th>
		</tr>";
	
	//display resulting rows in table	
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>
			<td align='center'>" . $row['userid'] . "</td>
			<td>" . $row['lastname'] . ", " . $row['firstname'] . " " . $row['middleinitial'] . "</td>
			<td>" . $row['username'] . "</td>
			<td>" . $row['email'] . "</td>
			<td>" . $row['name'] . "</td>
			<td>" . $row['rolename'] . "</td>
			<td>" . $row['classid'] . "</td>
			</tr>";
	}
	echo "</table> <br><br>";
} 

//////for Displaying report of Professors in a university///////////////////////////////////////////////////////////////////////////////////////////////
if (in_array(1, $userRoles) || in_array(2, $userRoles) || in_array(3, $userRoles)){//Site Admin sees all, University admin can only see Professors in their 		
																				   //University, and professors can only see themselves for reference to 
																				   //classes they are teaching.
	$whereStatement = null;
	if (in_array(1, $userRoles)){ //Site Admin, see all Professors and University
		$whereStatement = 'ur.roleid=3';
	} else if (in_array(2, $userRoles)){//University Admin, see all Professors within their University
	 	$userQuery = "SELECT universityid FROM users WHERE userid=" . $_SESSION['userid'];
		$result = mysqli_query ($dbc, $userQuery);
		while($row = mysqli_fetch_array($result)){
			$userUniversity = $row['universityid'];
		}
		$whereStatement = 'ur.roleid=3 AND u.universityid=' . $userUniversity;
	} else if (in_array(3, $userRoles)){//Professors, see themselves for reference as to which classes they are teaching.
	 	$whereStatement = 'ur.roleid=3 AND u.userid=' . $_SESSION['userid'];
	}

	//Query to append to with $whereStatement chosen above.
	$userQuery = "
		SELECT u.userid, u.firstname, u.middleinitial, u.lastname, u.email, uv.name, r.rolename, uc.classid, u.username FROM users u
		LEFT JOIN universities uv ON u.universityid = uv.universityid
		LEFT JOIN `users-roles` ur ON u.userid = ur.userid
        LEFT JOIN roles r ON ur.roleid=r.roleid
        LEFT JOIN `users-classes` uc ON u.userid = uc.userid
        WHERE $whereStatement
        ORDER BY $orderBy ";
        
	// execute query 
	$result = mysqli_query ($dbc, $userQuery);
	
	//Display Table headings	
	echo "<h1>Professors</h1>";
	echo "<table border='1' cellpadding='5' align='center' bgcolor='282164'>";
	echo "<tr bgcolor='9B1321'>
		  	<th>User ID</th>
			<th>Full Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>University</th>
			<th>Role</th>
			<th>Class</th>
		</tr>";
	
	//Display resulting query rows in table.	
	while($row = mysqli_fetch_array($result))
	{
		  echo "<tr>
		  			<td align='center'>" . $row['userid'] . "</td>
					<td>" . $row['lastname'] . ", " . $row['firstname'] . " " . $row['middleinitial'] . "</td>
					<td>" . $row['username'] . "</td>
					<td>" . $row['email'] . "</td>
					<td>" . $row['name'] . "</td>
					<td>" . $row['rolename'] . "</td>
					<td>" . $row['classid'] . "</td>
				</tr>";
	}
	echo "</table> <br><br>";
} 

//////for Displaying report of Students in a class///////////////////////////////////////////////////////////////////////////////////////////////////
if (in_array(1, $userRoles) || in_array(2, $userRoles) || in_array(3, $userRoles)){
	
	$whereStatement = null;
	if (in_array(1, $userRoles)){//Site Admin sees all classes
		$whereStatement = 'ur.roleid=4';
	} else if (in_array(2, $userRoles)){//University Admin sees all classes within his/her university
	 	$userQuery = "SELECT universityid FROM users WHERE userid=" . $_SESSION['userid'];
		$result = mysqli_query ($dbc, $userQuery);
		while($row = mysqli_fetch_array($result)){
			$userUniversity = $row['universityid'];
		}
		$whereStatement = 'ur.roleid=4 AND u.universityid=' . $userUniversity;
	} else if (in_array(3, $userRoles)){//Professor sees all classes he/she is teaching.
	 	$userQuery = "SELECT uc.classid FROM users u JOIN `users-classes` uc ON u.userid=uc.userid WHERE u.userid=" . $_SESSION['userid'];
		$userClass = null;
		$result = mysqli_query ($dbc, $userQuery);
		while($row = mysqli_fetch_array($result)){
			$userClass = ' uc.classid=' . $row['classid'];
			
		}
		$whereStatement = 'ur.roleid=4 AND ' . $userClass;
	}

	//Query to build upon with $whereStatment selection from above	
	$userQuery = "
		SELECT u.userid, u.firstname, u.middleinitial, u.lastname, u.email, uv.name, r.rolename, uc.classid, u.username 
		FROM users u
		LEFT JOIN universities uv ON u.universityid = uv.universityid
		LEFT JOIN `users-roles` ur ON u.userid = ur.userid
        LEFT JOIN roles r ON ur.roleid = r.roleid
        LEFT JOIN `users-classes` uc ON u.userid = uc.userid
        WHERE $whereStatement
        ORDER BY $orderBy ";
        
	// execute query 
	$result = mysqli_query ($dbc, $userQuery);
	
	//Display Headings	
	echo "<h1>Students</h1>";
	echo "<table border='1' cellpadding='5' align='center' bgcolor='282164'>";
	echo "<tr bgcolor='9B1321'>
		  	<th>User ID</th>
			<th>Full Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>University</th>
			<th>Role</th>
			<th>Class</th>
			<th>View Student Events</th>
		</tr>";
	
	//Display results for query as table rows	
	while($row = mysqli_fetch_array($result))
	{
		  echo "<tr>
		  			<td align='center'>" . $row['userid'] . "</td>
					<td>" . $row['lastname'] . ", " . $row['firstname'] . " " . $row['middleinitial'] . "</td>
					<td>" . $row['username'] . "</td>
					<td>" . $row['email'] . "</td>
					<td>" . $row['name'] . "</td>
					<td>" . $row['rolename'] . "</td>
					<td>" . $row['classid'] . "</td>
					<td><form id='viewStudentPosts' method='post' action='searchResults.php'>
							<button type='submit'  name='user_id' value='". $row['userid'] . "'>Student's Events</button>
		   				</form></td>
				</tr>";
	}
	echo "</table> <br><br>";
} 

//Close connection to DB	
mysqli_close($dbc);




?>


</p>


</body>
</html> 