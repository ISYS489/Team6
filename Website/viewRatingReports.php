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

$orderBy = "e.eventname";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 	if ($_POST['order_by'] == 'username'){ 
		////////////For diplaying reports of all users.	////////////////////////////////////////////////////////////////////////////////////////////////////
		$orderBy = "u.username";
	} else if ($_POST['order_by'] == 'rating'){
		////////////For diplaying reports of all users.	////////////////////////////////////////////////////////////////////////////////////////////////////
		$orderBy = "r.rating";
	} else if ($_POST['order_by'] == 'eventname') {
		////////////For diplaying reports of all users.	////////////////////////////////////////////////////////////////////////////////////////////////////
		$orderBy = "e.eventname";
	}
}

echo '<form method="post" align="center">Sort by: 
<input type="radio" name="order_by" value="eventname" onclick="viewUserReports.php">Event Name
<input type="radio" name="order_by" value="username" onclick="viewUserReports.php">Username
<input type="radio" name="order_by" value="rating" onclick="viewUserReports.php">Rating
<input type="submit" value="Sort">
</form>';

////////////For diplaying ratings per course.	////////////////////////////////////////////////////////////////////////////////////////////////////
	

$classQuery = "SELECT r.ratingid, e.eventname, u.username, r.rating, r.comment, e.isvisible
			   FROM ratings r
			   JOIN events e ON r.eventid = e.eventid
			   JOIN users u ON r.userid = u.userid
			   ORDER BY $orderBy
			  "; //WHERE ur.roleid=2

	/* execute multi query */
$result = mysqli_query ($dbc, $classQuery);	
	echo "<table border='1' cellpadding='5' align='center'>";
	echo "<tr bgcolor='9B1321'>
		  	<th>Rating ID</th>
			<th>Event Name</th>
			<th>Username</th>
			<th>Rating</th>
			<th>Comment</th>
			<th>Status of Event</th>
		</tr>";
	
		
	while($row = mysqli_fetch_array($result))
	{
		  echo "<tr>
		  			<td align='center'>" . $row['ratingid'] . "</td>
					<td>" . $row['eventname'] . "</td>
					<td>" . $row['username'] . "</td>
					<td>" . $row['rating'] . "</td>
					<td>" . $row['comment'] . "</td>
					<td>"; if ($row['isvisible']){
								echo "Active";
							} else {
								echo "Inactive";
							} "</td>
				</tr>";
	}
	echo "</table>";
	
mysqli_close($dbc);




?>


</p>


</body>
</html> 