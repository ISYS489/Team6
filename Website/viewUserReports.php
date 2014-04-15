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
	
	<h1>Welcome to the User Report Page</h1>
</head>

<body>

<p>


<?php
require ('../mysqli_connect.php');
$userRoles = array();

if ($_SESSION['userid']){
 	
	$userId = $_SESSION['userid'];
	$result = mysqli_query($dbc, "SELECT RoleId FROM `users-roles` WHERE UserId = $userId");
	while ($row = mysqli_fetch_array($result)){
		$userRoles[] = $row[0]; 
	}
}

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
echo '<form method="post" align="center">Sort by: 
<input type="radio" name="order_by" value="last_name" >Last Name
<input type="radio" name="order_by" value="class" >Class ID
<input type="radio" name="order_by" value="university" >University
<input type="submit" value="Sort">
</form>';

////////////For diplaying report of University Administrators.
if (in_array(1, $userRoles)){
	
	$userQuery = "
		SELECT u.userid, u.firstname, u.middleinitial, u.lastname, u.email, uv.name, r.rolename, uc.classid, u.username FROM users u
		LEFT JOIN universities uv ON u.universityid = uv.universityid
		LEFT JOIN `users-roles` ur ON u.userid = ur.userid
        LEFT JOIN roles r ON ur.roleid=r.roleid
        LEFT JOIN `users-classes` uc ON u.userid = uc.userid
        WHERE ur.roleid=2 
        ORDER BY $orderBy "; 

	// execute query 
	$result = mysqli_query ($dbc, $userQuery);	
	
	echo "<h1>Univeristy Administrators</h1>";
	echo "<table border='1' cellpadding='5' align='center'>";
	echo "<tr bgcolor='9B1321'>
		  	<th>User ID</th>
			<th>Full Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>University</th>
			<th>Role</th>
			<th>Class</th>
		</tr>";
	
		
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

//////for Displaying report of Professors in a university
if (in_array(1, $userRoles) || in_array(2, $userRoles)){
	
	$whereStatement = null;
	if (in_array(1, $userRoles)){
		$whereStatement = 'ur.roleid=3';
	} else if (in_array(2, $userRoles)){
	 	$userQuery = "SELECT universityid FROM users WHERE userid=" . $_SESSION['userid'];
		$result = mysqli_query ($dbc, $userQuery);
		while($row = mysqli_fetch_array($result)){
			$userUniversity = $row['universityid'];
		}
		$whereStatement = 'ur.roleid=3 AND u.universityid=' . $userUniversity;
	}

	
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
		
	echo "<h1>Professors</h1>";
	echo "<table border='1' cellpadding='5' align='center'>";
	echo "<tr bgcolor='9B1321'>
		  	<th>User ID</th>
			<th>Full Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>University</th>
			<th>Role</th>
			<th>Class</th>
		</tr>";
	
		
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

//////for Displaying report of Students in a class
if (in_array(1, $userRoles) || in_array(2, $userRoles) || in_array(3, $userRoles)){
	
	$whereStatement = null;
	if (in_array(1, $userRoles)){
		$whereStatement = 'ur.roleid=4';
	} else if (in_array(2, $userRoles)){
	 	$userQuery = "SELECT universityid FROM users WHERE userid=" . $_SESSION['userid'];
		$result = mysqli_query ($dbc, $userQuery);
		while($row = mysqli_fetch_array($result)){
			$userUniversity = $row['universityid'];
		}
		$whereStatement = 'ur.roleid=4 AND u.universityid=' . $userUniversity;
	} else if (in_array(3, $userRoles)){
	 	$userQuery = "SELECT uc.classid FROM users u JOIN `users-classes` uc ON u.userid=uc.userid WHERE u.userid=" . $_SESSION['userid'];
		$userClass = null;
		$result = mysqli_query ($dbc, $userQuery);
		while($row = mysqli_fetch_array($result)){
			$userClass = ' uc.classid=' . $row['classid'];
			
		}
		$whereStatement = 'ur.roleid=4 AND' . $userClass;
	}

		
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
		
	echo "<h1>Students</h1>";
	echo "<table border='1' cellpadding='5' align='center'>";
	echo "<tr bgcolor='9B1321'>
		  	<th>User ID</th>
			<th>Full Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>University</th>
			<th>Role</th>
			<th>Class</th>
		</tr>";
	
		
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
	
mysqli_close($dbc);




?>


</p>


</body>
</html> 