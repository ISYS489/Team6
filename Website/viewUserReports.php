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

$orderBy = "r.roleid";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 	if ($_POST['order_by'] == 'role'){ 
		////////////For diplaying reports of all users.	////////////////////////////////////////////////////////////////////////////////////////////////////
		$orderBy = "r.roleid";
	} else if ($_POST['order_by'] == 'class'){
		////////////For diplaying reports of all users.	////////////////////////////////////////////////////////////////////////////////////////////////////
		$orderBy = "uc.classid";
	} else if ($_POST['order_by'] == 'university') {
		////////////For diplaying reports of all users.	////////////////////////////////////////////////////////////////////////////////////////////////////
		$orderBy = "uv.name";
	}
}

echo '<form method="post" align="center">Sort by: 
<input type="radio" name="order_by" value="role" >Role
<input type="radio" name="order_by" value="class" >Class ID
<input type="radio" name="order_by" value="university" >University
<input type="submit" value="Sort">
</form>';
 
////////////For diplaying reports of all users.	////////////////////////////////////////////////////////////////////////////////////////////////////
$userQuery = "SELECT u.userid, u.firstname, u.middleinitial, u.lastname, u.email, uv.name, r.rolename, uc.classid FROM users u
					LEFT JOIN universities uv ON u.universityid = uv.universityid
					LEFT JOIN `users-roles` ur ON u.userid = ur.userid
                    LEFT JOIN roles r ON ur.roleid=r.roleid
                    LEFT JOIN `users-classes` uc ON u.userid = uc.userid
                    ORDER BY $orderBy
					"; //WHERE ur.roleid=2

	// execute query 
$result = mysqli_query ($dbc, $userQuery);	
	echo "<br><br><table border='1' cellpadding='5' align='center'>";
	echo "<tr bgcolor='9B1321'>
		  	<th>User ID</th>
			<th>Full Name</th>
			<th>Email</th>
			<th>University</th>
			<th>Role</th>
			<th>Class</th>
		</tr>";
	
		
	while($row = mysqli_fetch_array($result))
	{
		  echo "<tr>
		  			<td align='center'>" . $row['userid'] . "</td>
					<td>" . $row['firstname'] . " " . $row['middleinitial'] . " " . $row['lastname'] . "</td>
					<td>" . $row['email'] . "</td>
					<td>" . $row['name'] . "</td>
					<td>" . $row['rolename'] . "</td>
					<td>" . $row['classid'] . "</td>
				</tr>";
	}
	echo "</table> <br><br>";
	
mysqli_close($dbc);




?>


</p>


</body>
</html> 