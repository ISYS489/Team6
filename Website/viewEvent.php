<?php
//File Name: myPosts.php
//Purpose: Page lists events.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Thompson
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

    <h1>View Event</h1>

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
  
//initiate URL variable
global $url;  
  
  $whatever = $_GET['eid'];
  $result = mysqli_query($dbc, "SELECT events.eventid, events.eventname, events.publishdate, events.eventdesc, politicalparties.politicalparty, mediatypes.mediatype, newsoutlets.newsoutlet, events.url, users.username, names.name
FROM events 
INNER JOIN users 
ON events.userid = users.userid 
JOIN newsoutlets
ON events.newsoutletid = newsoutlets.newsoutletid
JOIN names
ON events.nameid = names.nameid
JOIN politicalparties
ON events.politicalpartyid = politicalparties.politicalpartyid
JOIN mediatypes
ON events.mediatypeid = mediatypes.mediatypeid");

echo "<table align='center'><tr><td>";

  while($row = mysqli_fetch_array($result))
  {

  echo "Event ID: " . $row['eventid'] . "<br>";
  echo "Event Name: " . $row['eventname'] . "<br>";
  echo "Publish Date: " . $row['publishdate'] . "<br>";
  echo "Event Description: " . $row['eventdesc'] . "<br>";
  echo "Person of Interest: " . $row['name'] . "<br>";
  echo "News Outlet: " . $row['politicalparty'] . "<br>";
  echo "Media Type: " . $row['mediatype'] . "<br>";
  echo "News Outlet: " . $row['newsoutlet'] . "<br>";
  echo "User Name: " . $row['username'] . "<br>";
  $url = "'" . $row['url'] . "'";
  

  }



mysqli_close($dbc);
?>

</td><td>
<FORM>
	<INPUT Type='BUTTON' VALUE='View Event Website' ONCLICK="window.location.href='<php? $url ?>'"> 
	
</FORM>

	
</td></tr></table>

</body>
</html>
