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
  
  
  $whatever = $_GET['eid'];
  $result = mysqli_query($dbc, "SELECT events.eventid, events.eventname, events.publishdate, events.eventdesc, events.politicalpartyid, events.mediatypeid, events.newsoutletid, events.url, users.username
   FROM events INNER JOIN users ON events.userid = users.userid where events.eventid = $whatever");

echo "<table align='center'><tr><td>";

  while($row = mysqli_fetch_array($result))
  {

  echo "event id: " . $row['eventid'] . "<br>";
  echo "event name: " . $row['eventname'] . "<br>";
  echo "publish date: " . $row['publishdate'] . "<br>";
  echo "event description: " . $row['eventdesc'] . "<br>";
  echo "news outlet id: " . $row['politicalpartyid'] . "<br>";
  echo "media type id: " . $row['mediatypeid'] . "<br>";
  echo "news outlet id: " . $row['newsoutletid'] . "<br>";
  echo "user name: " . $row['username'] . "<br>";
  $url = $row['url'];
  echo "</td><td><FORM>
				 <INPUT Type='BUTTON' VALUE='Home Page' ONCLICK='window.location.href='" . $url . "'> 
                  </FORM>";

  }

echo "</td></tr></table>";

mysqli_close($dbc);
?>

</body>
</html>
