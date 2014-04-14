<?php
//File Name: viewEvent.php
//Purpose: Displays information for a specific event, allows event ratings.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Thompson
//Last Date Modified: 3/28/2014


	//start the session & set logged in user's ID
	session_start();
	 
	require 'mysqliConnect.php';
	
	//check to see what role(s) user has.
	if ($_SESSION['userid']){
	 
	    $userId = $_SESSION['userid'];
	    $userRoles = array();
	    $result = mysqli_query($dbc, "SELECT RoleId FROM `users-roles` WHERE UserId = $userId");
	    while ($row = mysqli_fetch_array($result)){
	    	$userRoles[] = $row[0];
	   	};
	}
	require 'header.php';
	
//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$errors = array(); //Initialize an error array.
	
	//Check for a comment
	if (empty($_POST['comment'])) {
	$errors[] = 'You forgot to enter a comment.';
	}else{
	$ec = trim($_POST['comment']);
	}
	
	//Check for a rating		
	if (empty($_POST['rating'])) {
	$errors[] = 'You forgot to enter a rating.';
	}else{
	$er = trim($_POST['rating']);
	}
		
	//Check login for userid
	if (empty($_SESSION['userid'])) {
	$errors[] = 'You are not logged in.';
	}else{
	$uid = trim($_SESSION['userid']);
	}
	
	if (empty($errors)) { //if there are no errors
		//connect to the DB
		require ('mysqliConnect.php');
		
		//make the query
		$q = "INSERT INTO ratings (eventid, userid, rating, comment) VALUES ('" . $_GET['eid'] . "','$uid','$er','$ec')";
		$r = mysqli_query ($dbc, $q); //run query
		
		if ($r) {//if it ran ok
		
			//print message:
			echo '<h1>Thank You!</h1>
			<p>You have submitted a rating.</p>';

		}else{ //if not ok
	
			echo '<h1>Error</h1>
			<p>System error preventing rating creation.</p>';
		}
		
		mysqli_close($dbc);
	
	} else {
	
		echo '<h1>Error!</h1>
		<p>The following error(s) occurred:<br />';
		foreach ($errors as $msg) { //print each
		echo " - $msg<br />\n";
	}

	echo '</p><p>Please try again.</p><p><br /></p>';
	
	}
}
?>

<html>

<head>



</head>
<body>

    <h1>View Event</h1>

  <?php
	///Display event information
	require 'mysqliConnect.php';
  
  	$event_id = $_GET['eid'];
  	
  	$result = mysqli_query($dbc, 
	"SELECT e.eventid, e.eventname, e.publishdate, e.eventdesc, pp.politicalparty, mt.mediatype, no.newsoutlet, e.url, u.username, n.name
	FROM events e
	INNER JOIN users 	  u 	ON e.userid = u.userid 
	JOIN newsoutlets 	  no 	ON e.newsoutletid = no.newsoutletid
	JOIN names       	  n 	ON e.nameid = n.nameid
	JOIN politicalparties pp 	ON e.politicalpartyid = pp.politicalpartyid
	JOIN mediatypes       mt 	ON e.mediatypeid = mt.mediatypeid where e.eventid = $event_id");

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
		  echo "</td><td>";
		  echo "<a href=\"".$row['url']."\" id='viewevent' target='_blank' ><INPUT Type='BUTTON' VALUE='View Event Website'></a>" . "</td>";
	}

mysqli_close($dbc);


?>




	
</td></tr></table>
<h1> Ratings: </h1>

///Displays Ratings that match event ID
<?php
require 'mysqliConnect.php';

	$result = mysqli_query($dbc,"SELECT ratings.rating, ratings.comment, users.username from ratings JOIN users ON ratings.userid = users.userid
	where ratings.eventid = $event_id");
	
	echo "<table align='center' border='1'>
	<tr>
	<th> Username </th>
	<th> rating </th>
	<th> comment </th>
	</tr>";
	
	
	  while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['username'] . "</td>";
	  echo "<td>" . $row['rating'] . "</td>";
	  echo "<td>" . $row['comment'] . "</td>";
	  echo "</tr>";
	  }
	
	echo "</table>";
	
	

$activeUser = false;

//check to see if current user is active
if (!empty($userId)){
 
	$result = mysqli_query($dbc, "SELECT IsActive FROM users WHERE UserId = $userId");
	
	while ($row = mysqli_fetch_array($result)){
		$activeUser = $row[0];
	}	
}

//Display ability to add rating only if user is active	
if ($activeUser){
	echo "
	<br><br>
	<form class ='search' id='add_comment' method='post' action='viewEvent.php?eid=$event_id'>
		<table align='center' border='1'>
			<tr>
				<th> Submit </th>
				<th> Rating </th>
				<th> Comment </th>
			</tr>
			<tr>
				<th> <button type='submit' action='viewEvent.php?eid='$event_id'>Submit Rating</button> </th>
				<th> <input type='text' placeholder='Rating' name='rating' autofocus /><br></br> </th>
				<th> <input type='text' placeholder='Comment' name='comment' autofocus /><br></br> </th>
			</tr>
		</table>
	</form>
	";
}



mysqli_close($dbc);
	
?>

</body>
</html>
