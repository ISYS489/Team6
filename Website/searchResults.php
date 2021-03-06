<?php
//File Name: searchResults.php
//Purpose: This page displays results from the search page.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle T., Cale Kuchnicki
//Last Date Modified: 4/17/2014


//start the session
session_start();
?>


<html>

<head>
<!--header-->


<?php 
	//include header file
	require 'header.php';
	require '../mysqli_connect.php';
?>
</head>


<div class="slideUp">
<h1>Search Results</h1>

<?php

//initialize search string variable
$searchString = null;

//check for searchable items
if (!empty($_POST['eventname'])){
	$searchString = " and e.eventname like '%{$_POST['eventname']}%'";	
}
if (!empty($_POST['rating'])){
	$searchString = $searchString . " and a.rating = '{$_POST['rating']}'";	
}
if (!empty($_POST['media_type'])){
	$searchString = $searchString . " and m.MediaTypeId = '{$_POST['media_type']}'";	
}
if (!empty($_POST['political_party'])){
	$searchString = $searchString . " and p.PoliticalPartyId = '{$_POST['political_party']}'";	
}
if (!empty($_POST['university'])){
	$searchString = $searchString . " and z.Name = '{$_POST['university']}'";	
}
if (!empty($_POST['coursenumber'])){
	$searchString = $searchString . " and q.classid = '{$_POST['coursenumber']}'";	
}
if (!empty($_POST['name'])){
	$searchString = $searchString . " and n.nameid = '{$_POST['name']}'";	
}
if (!empty($_POST['news_outlet'])){
	$searchString = $searchString . " and nO.newsoutletid = '{$_POST['news_outlet']}'";	
}
if (!empty($_POST['user_id'])){
	$searchString = $searchString . " and g.userid = '{$_POST['user_id']}'";	
}
if (!empty($_POST['StartYear']) AND !empty($_POST['EndYear'] )){
 	if ($_POST['StartYear'] < $_POST['EndYear']){
		$searchString = $searchString . " AND year(e.DateOfEvent) > '{$_POST['StartYear']}' AND year(e.DateOfEvent) < '{$_POST['EndYear']}'";		
	}	
}


//event query 
$result = mysqli_query($dbc,"SELECT  DISTINCT e.EventId, e.EventName, date(e.PublishDate) AS PublishDate, e.DateOfEvent, p.PoliticalParty, nO.NewsOutlet, m.MediaType, n.Name, round(avg(a.rating)) as rating, z.name, q.classid
FROM events AS e
LEFT OUTER JOIN politicalparties AS p ON e.PoliticalPartyId = p.PoliticalPartyId
LEFT OUTER JOIN newsoutlets AS nO ON e.NewsOutletId = nO.NewsOutletId
LEFT OUTER JOIN names AS n ON e.NameId = n.NameId
LEFT OUTER JOIN mediatypes AS m ON e.MediaTypeId = m.MediaTypeId
left outer join ratings as a on e.eventid = a.eventid
left outer join users as g on e.userid = g.userid
left outer join universities as z on g.UniversityId = z.UniversityId
left outer join `users-classes` as f on g.userId = f.userId
left outer join classes as q on f.classid = q.classid
WHERE e.isvisible=true  $searchString    
group by e.EventName"); 

//display event table
echo "<div id='searchlistresize'>
<table border='1' class='searchlist' align='center'>
<tr bgcolor='9B1321' >
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
</tr>
</div>";

	// display event rows
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

<!--display button to search again-->
<form class ="searchresults" id="searchresults" method="post" action="search.php">
<button type="submit" >Search Again</button>
</form>




</body>
</div>
</html> 
