<?php
//File Name: myPosts.php
//Purpose: Page lists events.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Thompson
//Last Date Modified: 3/28/2014


//start the session & set logged in user's ID
session_start();
$userID = $_SESSION['userid'];
?>


<html>

<head>


<?php
	// header page info and DB connection files
	  require 'header.php';
          require ('../mysqli_connect.php');
	
?>	
	


</head>
<body>

    <h1>My Posts</h1>
<div class="pullup">
<?php

  
  //select statement
  $result = mysqli_query($dbc, "SELECT events.eventid, events.eventname, events.publishdate, events.eventdesc, events.politicalpartyid, events.mediatypeid, events.newsoutletid, users.userid
   FROM events JOIN users ON events.userid = users.userid
   where events.userid = $userID");
  



	echo "<table border='1'>
	<tr bgcolor='9B1321' >
	<th> event id</th>
	<th>event name</th>
	<th> publish date</th>
	<th> event description</th>
	<th> political party id</th>
	<th> media type id</th>
	<th> news outlet id </th>
	<th> user id  </th>
	<th> click below to view event</th>
	</tr>";

   //show table results
  while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['eventid'] . "</td>";
  echo "<td>" . $row['eventname'] . "</td>";
  echo "<td>" . $row['publishdate'] . "</td>";
  echo "<td>" . $row['eventdesc'] . "</td>";
  echo "<td>" . $row['politicalpartyid'] . "</td>";
  echo "<td>" . $row['mediatypeid'] . "</td>";
  echo "<td>" . $row['newsoutletid'] . "</td>";
  echo "<td>" . $row['userid'] . "</td>";
  echo "<td>" . "<a href=\"viewEvent.php?eid=".$row['eventid']."\" id='eventlist'>Click Here To View This Event</a>" . "</td>";
  echo "</tr>";
  }
echo "</table>";



?>
</div>
</body>
</html>
