<?php
//File Name: eventList.php
//Purpose: Page lists events.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Gottfried
//Last Date Modified: 3/28/2014


//start the session & set logged in user's ID
session_start();
?>


<html>

<head>

    <?php require 'header.php';
require 'mysqliConnect.php';
?>


</head>
<body>

    <h1>Event List</h1>
<?php

//DEFINE ('DB_USER', 'isys489c_thompk');
//DEFINE ('DB_PASSWORD', 'q8K[A4LJDd&]');
//DEFINE ('DB_HOST', 'localhost');
//DEFINE ('DB_NAME', 'isys489c_brteam6');

////Make Connection   @= hide errors                                    die will terminate function of the script
//$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
//if (mysqli_connect_errno())
//  {
//  echo "Failed to connect to MySQL: " . mysqli_connect_error();
//  }

$result = mysqli_query($dbc,"SELECT e.EventName, e.EventId, e.userid, date(e.PublishDate) AS PublishDate, e.DateOfEvent, p.PoliticalParty, nO.NewsOutlet, m.MediaType, n.Name, avg(z.rating) as rating, x.name
FROM events AS e
LEFT OUTER JOIN politicalparties AS p ON e.PoliticalPartyId = p.PoliticalPartyId
LEFT OUTER JOIN newsoutlets AS nO ON e.NewsOutletId = nO.NewsOutletId
LEFT OUTER JOIN names AS n ON e.NameId = n.NameId
LEFT OUTER JOIN mediatypes AS m ON e.MediaTypeId = m.MediaTypeId
left outer join ratings as z on e.eventid = z.eventid
left outer join users as q on e.UserId = q.UserId
left outer join universities as x on q.universityid = x.universityid
where e.isVisible=true
group by e.EventName");



echo "<table border='1' class='eventlist' align='center'>
<tr bgcolor='9B1321' >
<th>Event Name</th>
<th> Publish Date</th>
<th> Date of Event</th>
<th> Political Party</th>
<th> Media Type</th>
<th> News Outlet</th>
<th> Rating</th>
<th> University</th>
<th> click below to view event </th>
</tr>";


  while($row = mysqli_fetch_array($result))
  
  {
  echo "<tr>";
  echo "<td>" . $row['EventName'] . "</td>";
  echo "<td>" . $row['PublishDate'] . "</td>";
  echo "<td>" . $row['DateOfEvent'] . "</td>";
  echo "<td>" . $row['PoliticalParty'] . "</td>";
  echo "<td>" . $row['MediaType'] . "</td>";
  echo "<td>" . $row['NewsOutlet'] . "</td>";
  echo "<td>" . $row['rating'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . "<a href=\"viewEvent.php?eid=".$row['EventId']."\" id='eventlist' >Click Here To View This Event</a>" . "</td>";
  echo "</tr>";
  }
  
 
echo "</table>";




mysqli_close($dbc);


?>
</body>
</html>
