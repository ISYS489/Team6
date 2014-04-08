<?php
//File Name: classPosts.php
//Purpose: Page lists events.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Thompson
//Last Date Modified: 3/28/2014


//start the session & set logged in user's ID
session_start();
$userID = $_SESSION['userId'];
?>


<html>

<head>

    <?php include("header.php");?>

</head>
<body>

    <h1>Class Posts</h1>
  <?php

DEFINE ('DB_USER', 'isys489c_thompk');
DEFINE ('DB_PASSWORD', 'q8K[A4LJDd&]');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'isys489c_brteam6');

//Make Connection   @= hide errors                                    die will terminate function of the script
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $result = mysqli_query($dbc, "SELECT events.eventid, events.eventname, events.publishdate, events.eventdesc, events.politicalpartyid, events.mediatypeid, events.newsoutletid, classes.classid, classes.classname
   FROM events  JOIN users ON events.userid = users.userid  join classes on users.universityid = classes.universityid");
  



echo "<table border='1'>
<tr>
<th> event id</th>
<th>event name</th>
<th> publish date</th>
<th> event description</th>
<th> political party id</th>
<th> media type id</th>
<th> news outlet id </th>
<th> course id   </th>
<th> course name   </th>
<th> click below to view event</th>
</tr>";


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
  echo "<td>" . $row['classid'] . "</td>";
  echo "<td>" . $row['classname'] . "</td>";
  echo "<td>" . "<a href=\"viewEvent.php?eid=".$row['eventid']."\" id='eventlist'>Click Here To View This Event</a>" . "</td>";
  echo "</tr>";
  }
echo "</table>";
mysqli_close($dbc);
?>


</body>
</html>
