<?php
//File Name: report.php
//Purpose: Displays reporting options.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 4/10/2014

//start the session
session_start();
?> 

<html>

<head>
	<?php require 'header.php'; ?>
	
	<h1>Welcome to the Report Page</h1>
</head>

<body>

<p>

<?php

/**
* $result = mysqli_query($dbc,"SELECT eventid, eventname, publishdate, eventdesc, politicalpartyid, mediatypeid, newsoutletid  FROM users");


* "Failed to connect to MySQL: " . mysqli_connect_error();
* //  }

* $result = mysqli_query($dbc,"SELECT eventid, eventname, publishdate, eventdesc, politicalpartyid, mediatypeid, newsoutletid  FROM events");

* echo "<table border='1'>
* <tr>
* <th> event id</th>
* <th>event name</th>
* <th> publish date</th>
* <th> event description</th>
* <th> political party id</th>
* <th> media type id</th>
* <th> news outlet id </th>
* <th> click below to view event </th>
* </tr>";


*   while($row = mysqli_fetch_array($result))
*   {
*   echo "<tr>";
*   echo "<td>" . $row['eventid'] .  "</td>";
*   echo "<td>" . $row['eventname'] . "</td>";
*   echo "<td>" . $row['publishdate'] . "</td>";
*   echo "<td>" . $row['eventdesc'] . "</td>";
*   echo "<td>" . $row['politicalpartyid'] . "</td>";
*   echo "<td>" . $row['mediatypeid'] . "</td>";
*   echo "<td>" . $row['newsoutletid'] . "</td>";
*    echo "<td><a href='viewEvent.php'>Click here to view event</a></td>";
*   echo "</tr>";
*   }
* echo "</table>";

* mysqli_close($dbc);
*/

require ('mysqliConnect.php');
	
$deactivateQuery = "SELECT u.userid, u.username, uv.name, r.rolename FROM users u
					JOIN universities uv ON u.universityid = uv.universityid
					JOIN `users-roles` ur ON u.userid = ur.userid
                    JOIN roles r ON ur.roleid=r.roleid
                    ORDER BY r.roleid
					"; //WHERE ur.roleid=2
	/* execute multi query */
$result = mysqli_query ($dbc, $deactivateQuery);	
	echo "<table border='1' cellpadding='5' align='center'>";
	echo "<tr>
		  	<th>User ID</th>
			<th>Username</th>
			<th>University</th>
			<th>Role:</th>
		</tr>";
	
		
	while($row = mysqli_fetch_array($result))
	{
		  echo "<tr>
		  			<td align='center'>" . $row['userid'] . "</td>
					<td>" . $row['username'] . "</td>
					<td>" . $row['name'] . "</td>
					<td>" . $row['rolename'] . "</td>
				</tr>";
	}
	echo "</table";
	


mysqli_close($dbc);

?>



</p>


</body>
</html> 
