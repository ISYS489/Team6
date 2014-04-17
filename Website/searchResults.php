<?php
session_start();
?>
//start the session

<html>

<head>
<!--header-->

<?php require 'header.php';
require 'mysqliConnect.php';
?>
</head>




<h1>Search Results</h1>

<?php
 
$result = mysqli_query($dbc,"SELECT  DISTINCT e.EventId, e.EventName, date(e.PublishDate) AS PublishDate, e.DateOfEvent, p.PoliticalParty, nO.NewsOutlet, m.MediaType, n.Name, avg(a.rating) as rating, z.name, q.classid
FROM events AS e
LEFT OUTER JOIN politicalparties AS p ON e.PoliticalPartyId = p.PoliticalPartyId
LEFT OUTER JOIN newsoutlets AS nO ON e.NewsOutletId = nO.NewsOutletId
LEFT OUTER JOIN names AS n ON e.NameId = n.NameId
LEFT OUTER JOIN mediatypes AS m ON e.MediaTypeId = m.MediaTypeId
left outer join ratings as a on e.eventid = a.eventid
left outer join users as g on e.userid = g.userid
left outer join universities as z on g.UniversityId = z.UniversityId
left outer join classes as q on g.universityid = q.universityid
WHERE e.isvisible=true and e.eventname = '{$_POST['eventname']}' or a.rating = '{$_POST['rating']}' or m.MediaTypeId = '{$_POST['media_type']}' or p.PoliticalPartyId = '{$_POST['political_party']}' or z.Name = '{$_POST['university']}' or q.classid = '{$_POST['coursenumber']}' or n.nameid = '{$_POST['name']}' or nO.newsoutletid = '{$_POST['news_outlet']}'
group by e.EventName");
//where eventname = '{$_POST['search']}'");


echo "<table border='1' class='searchlist' align='center'>
<tr>
<th>Event Name</th>
<th> Publish Date</th>
<th> Date of Event</th>
<th> Political Party</th>
<th>Person of interest</th>
<th> Media Type</th>
<th> News Outlet</th>
<th>Rating</th>
<th>University</th>
<th>Course Number</th>
<th> click below to view event </th>
</tr>";


  while($row = mysqli_fetch_array($result))
  
  {
  echo "<tr>";
  echo "<td>" . $row['EventName'] . "</td>";
  echo "<td>" . $row['PublishDate'] . "</td>";
  echo "<td>" . $row['DateOfEvent'] . "</td>";
  echo "<td>" . $row['PoliticalParty'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['MediaType'] . "</td>";
  echo "<td>" . $row['NewsOutlet'] . "</td>";
  echo "<td>" . $row['rating'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['classid'] . "</td>";
  echo "<td>" . "<a href=\"viewEvent.php?eid=".$row['EventId']."\" id='eventlist' >Click Here To View This Event</a>" . "</td>";
  echo "</tr>";
  }
  
  
echo "</table>";


mysqli_close($dbc);
?> 


<body>


<form class ="searchresults" id="searchresults" method="post" action="search.php">
<button type="submit" >Search Again</button>
</form>




</body>
<?php include("footer.php");?>
</html> 
