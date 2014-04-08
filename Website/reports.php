<?php


//start the session
session_start();
?> 

-->



<html>


<head>
<!--header-->

<?php require 'header.php';
require 'mysqliConnect.php';
?>

<h1>Report Page</h1>
</head>

<body>

<p>
<h1>Welcome to the Report Page</h1>
</p>
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

$result = mysqli_query($dbc,"SELECT eventid, eventname, publishdate, eventdesc, politicalpartyid, mediatypeid, newsoutletid  FROM events");

echo "<table border='1'>
<tr>
<th> event id</th>
<th>event name</th>
<th> publish date</th>
<th> event description</th>
<th> political party id</th>
<th> media type id</th>
<th> news outlet id </th>
<th> click below to view event </th>
</tr>";


  while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['eventid'] .  "</td>";
  echo "<td>" . $row['eventname'] . "</td>";
  echo "<td>" . $row['publishdate'] . "</td>";
  echo "<td>" . $row['eventdesc'] . "</td>";
  echo "<td>" . $row['politicalpartyid'] . "</td>";
  echo "<td>" . $row['mediatypeid'] . "</td>";
  echo "<td>" . $row['newsoutletid'] . "</td>";
   echo "<td><a href='viewEvent.php'>Click here to view event</a></td>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($dbc);


?>


</p>


</body>
</html> 
