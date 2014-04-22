<?php
//File Name: classPosts.php
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
  require 'header.php';
          require ('mysqliConnect.php');
	
?>	
	

</head>
<body>

    <h1>Class Posts</h1>
	<div class="myposts">
  <?php


$result = mysqli_query($dbc, "SELECT uc.classid FROM users u left outer join `users-classes` as uc on uc.userId = u.userId WHERE u.userid=" . $userID);
while($row = mysqli_fetch_array($result))
  {
   $classID = $row['classid'];
  }

$query = "SELECT DISTINCT e.EventId, e.EventName, uc.ClassId, c.ClassName, u.UserId, u.username, e.PublishDate, e.DateOfEvent, pp.PoliticalParty, mt.MediaType, no.NewsOutlet, n.Name
  from events as e
  left outer join users as u on u.UserId = e.UserId
  left outer join `users-classes` as uc on uc.userId = e.userId
  left outer join classes as c on c.classid = uc.classid
  left outer join universities as uv on u.UniversityId = uv.UniversityId
  left outer join politicalparties as pp on e.PoliticalPartyId = pp.PoliticalPartyId
  left outer join mediatypes as mt on e.MediaTypeId = mt.MediaTypeId
  left outer join newsoutlets as no on e.NewsOutletId = no.NewsOutletId
  left outer join names as n on e.NameId = n.NameId
  where e.isvisible = 1 AND c.classid =" . $classID;
  
  $result = mysqli_query($dbc, $query);
   
		
echo "<table border='1'>
<tr bgcolor='9B1321' >
<th>Class ID</th>
<th>Class Name</th>
<th>Username</th>
<th>Event ID</th>
<th>Event Name</th>
<th> Publish Date</th>
<th> Date of Event</th>
<th> Political Party</th>
<th> Media Type</th>
<th> News Outlet</th>
<th> Name </th>
<th> click here to view event</th>
</tr>";


  while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['ClassId'] . "</td>";
  echo "<td>" . $row['ClassName'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
	  echo "<td>" . $row['EventId'] . "</td>";
	    echo "<td>" . $row['EventName'] . "</td>";
		  echo "<td>" . $row['PublishDate'] . "</td>";
		    echo "<td>" . $row['DateOfEvent'] . "</td>";
			  echo "<td>" . $row['PoliticalParty'] . "</td>";
			    echo "<td>" . $row['MediaType'] . "</td>";
				  echo "<td>" . $row['NewsOutlet'] . "</td>";
				    echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . "<a href=\"viewEvent.php?eid=".$row['EventId']."\" id='eventlist'>Click Here To View This Event</a>" . "</td>";
  echo "</tr>";
  }
  
  
echo "</table>";

?>
</div>

</body>
</html>
