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

//$results = mysqli_query($dbc,"SELECT a.eventid, a.eventname, a.publishdate, a.eventdesc, b.politicalparty, c.mediatype, d.newsoutlet, e.rating, e.comment
 //FROM events a
 //full outer join politicalparties b
 //on a.politicalpartyid = b.politicalpartyid 
 //full outer join mediatypes c
 //full outer join newsoutlets d
 //on a.newsoutletid = d.newsoutletid
 //full outer join ratings e
 //on a.eventid = e.eventid
 //Where a.eventname like '%{$_POST['eventname']}%', or e.rating like '%{$_POST['rating']}%', or c.mediatype like '%{$_POST['mediatype']}%', or b.politicalparty like '%{$_POST['politicalparty']}%'");
 
$result = mysqli_query($dbc,"SELECT eventid, eventname, publishdate, eventdesc, politicalpartyid, mediatypeid, newsoutletid
from events
where eventname like '%{$_POST['eventname']}%'");

echo "<table border='1'>
<tr>
<th> event id</th>
<th>event name</th>
<th> publish date</th>
<th> event description</th>
<th> political party id</th>
<th> media type id</th>
<th> news outlet id </th>
<th> rating </th>
<th> comment </th>
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
  echo "<td>" . $row['rating'] . "</td>";
  echo "<td>" . $row['comment'] . "</td>";
  echo "<td>" . "<a href=\"viewEvent.php?eid=".$row['eventid']."\" id='eventlist'>Click Here To View This Event</a>" . "</td>";
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
</html> 
