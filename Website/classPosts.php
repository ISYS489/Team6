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
  <?php


  
  
  $result = mysqli_query($dbc, "SELECT a.ClassId, a.ClassName, d.UserId, e.EventId, e.EventName, e.PublishDate, e.DateOfEvent, f.PoliticalParty, g.MediaType, h.NewsOutlet, i.Name
  from classes as a
  left outer join universities as b on a.UniversityId = b.UniversityId
  left outer join `users-classes` as c on a.ClassId = c.ClassId
  left outer join users as d on c.UserId = d.UserId
  left outer join events as e on d.UserId = e.UserId
  left outer join politicalparties as f on e.PoliticalPartyId = f.PoliticalPartyId
  left outer join mediatypes as g on e.MediaTypeId = g.MediaTypeId
  left outer join newsoutlets as h on e.NewsOutletId = h.NewsOutletId
  left outer join names as i on e.NameId = i.NameId
  where d.UserId = $userID");



echo "<table border='1'>
<tr>
<th>class id</th>
<th>class name</th>
<th>User id</th>
<th>event id</th>
<th>event name</th>
<th> publish date</th>
<th> date of event/th>
<th> political party</th>
<th>media type</th>
<th> news outlet</th>
<th> name </th>
<th> click here to view event</th>
</tr>";


  while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['ClassId'] . "</td>";
  echo "<td>" . $row['ClassName'] . "</td>";
    echo "<td>" . $row['UserId'] . "</td>";
	  echo "<td>" . $row['EventId'] . "</td>";
	    echo "<td>" . $row['EventName'] . "</td>";
		  echo "<td>" . $row['PublishDate'] . "</td>";
		    echo "<td>" . $row['DateOfEvet'] . "</td>";
			  echo "<td>" . $row['PoliticalParty'] . "</td>";
			    echo "<td>" . $row['MediaType'] . "</td>";
				  echo "<td>" . $row['NewsOutlet'] . "</td>";
				    echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . "<a href=\"viewEvent.php?eid=".$row['eventid']."\" id='eventlist'>Click Here To View This Event</a>" . "</td>";
  echo "</tr>";
  }
  
  
echo "</table>";

?>


</body>
</html>
