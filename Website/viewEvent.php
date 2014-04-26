<?php
//File Name: viewEvent.php
//Purpose: Displays information for a specific event, allows event ratings.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Thompson, Cale Kuchnicki
//Last Date Modified: 4/13/2014


	//start the session & set logged in user's ID
	session_start();
	 
	require '../mysqli_connect.php';
	
	//variable to test for displaying form to deactivate an event.
	$allowDeactivate=false;
	
	$userRoles = array();
	//check to see what role(s) user has. 1 is site admin; 2 is university admin; 3 is professor; 4 is student
	if ($_SESSION['userid']){
	 
	    $userId = $_SESSION['userid'];
	    
	    $result = mysqli_query($dbc, "SELECT RoleId FROM `users-roles` WHERE UserId = $userId");
	    while ($row = mysqli_fetch_array($result)){
	    	$userRoles[] = $row[0]; 
	   	}
	   	
	   	
		if (in_array(1, $userRoles)){ //if user is Site Admin (1), Allow deactivation of event
			$allowDeactivate=true;
		}else if (in_array(2, $userRoles)){//If user is University Admin (2), Allow Deactivation if event is in univeristy
			
			$userUniversityID = null;
			$eventUniversityID = null;
			$event_id = $_GET['eid'];
			
			$result = mysqli_query($dbc, "SELECT universityid FROM users WHERE UserId = $userId");
	    	while ($row = mysqli_fetch_array($result)){
	    		 $userUniversityID = $row['universityid'];
	   		}	 
	   		$result = mysqli_query($dbc, "SELECT u.universityid FROM events e JOIN users u ON e.userid=u.userid WHERE e.eventid = $event_id");
	    	while ($row = mysqli_fetch_array($result)){
	    		 $eventUniversityID = $row['universityid'];
	   		}
			
			if ($eventUniversityID == $userUniversityID){
				$allowDeactivate=true;
			}	
		}else if (in_array(3, $userRoles)){//If user is Professor (3), Allow Deactivation if event is in professor's course.
			
			$userClassArray = array();
			$eventClassID = null;
			$event_id = $_GET['eid'];
			
			$result = mysqli_query($dbc, "SELECT classid FROM `users-classes` WHERE UserId = $userId");
	    	while ($row = mysqli_fetch_array($result)){
	    		 $userClassArray[] = $row[0];
	   		}
			$result = mysqli_query($dbc, "SELECT uc.classid FROM events e JOIN `users-classes` uc ON uc.userid=e.userid  WHERE e.eventid = $event_id");
	    	while ($row = mysqli_fetch_array($result)){
	    		 $eventClassID = $row['classid'];
	    		 if (in_array($eventClassID, $userClassArray)){
					$allowDeactivate=true;
				 }
	   		}
	   		
		}  	
	
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
		require ('../mysqli_connect.php');
		
		
		
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
	 	
	 	if ($_POST['deactivate_event'] == 'deactivate'){
			//make the query
			$dq = "UPDATE events SET isvisible=false WHERE eventid='" .$_GET['eid'] . "'";
			$dr = mysqli_query ($dbc, $dq); //run query
			if ($dr) {//if it ran ok
		
			//print message:
			echo '<h1>Thank You!</h1>
			<p>You have deactivated the event.</p>';

			}else{ //if not ok
	
			echo '<h1>Error</h1>
			<p>System error preventing deactivation.</p>';
			}
		} else if (!empty($_POST['deactivate_rating'])){
			//make the query
			foreach($_POST['deactivate_rating'] as $ratingID){
						
				$dq = "UPDATE ratings SET isactive=false WHERE ratingid='" . $ratingID . "'";
				$dr = mysqli_query ($dbc, $dq); //run query
				if ($dr) {//if it ran ok
			
					//print message:
					echo '<h1>Thank You!</h1>
					<p>You have deactivated the rating.</p>';
	
				}else{ //if not ok
		
					echo '<h1>Error</h1>
					<p>System error preventing deactivation.</p>';
				}			
			}
			
		} else {
	
			echo '<h1>Error!</h1>
			<p>The following error(s) occurred:<br />';
			foreach ($errors as $msg) { //print each
			echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p><p><br /></p>';
		}	
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

	echo "<table align='center' bgcolor='282164'><tr><td>";

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
		  echo "<a href=\"".$row['url']."\" id='viewevent' target='_blank' ><INPUT Type='BUTTON' VALUE='View Event Website'></a></br>";
		  //allow deactivation if in control
		  if ($allowDeactivate){
			echo '<form id="deactivate_event" method="post" action="viewEvent.php?eid='.$event_id.'">
				<input type="checkbox" name="deactivate_event" value="deactivate"><font color="white">Deactivate</font> 
				<button type="submit" action="viewEvent.php?eid='.$event_id.'">Submit Change</button>
		   	</form></td>';
		  }
		  
	}

mysqli_close($dbc);


?>




	
</td></tr></table>
<h1> Ratings: </h1>


<?php
///Displays Ratings that match event ID
require 'mysqliConnect.php';

	$result = mysqli_query($dbc,"SELECT r.ratingid, r.rating, r.comment, date(r.ratingdate) as ratingdate, u.username from ratings r JOIN users u ON r.userid = u.userid
	where r.eventid = $event_id AND r.isactive=true" );
	
	echo '<form class="deactivate" id="deactivate_event" method="post" action="viewEvent.php?eid='.$event_id.'">';
	echo '<table align="center"  bgcolor="282164" border="1">
	<tr>
	<th> Username </th>
	<th> Rating </th>
	<th> Comment </th>
	<th> Date </th>';
	if (in_array(1, $userRoles) OR in_array(2, $userRoles) OR in_array(3, $userRoles))
	{
		echo '<th><button type="submit" action="viewEvent.php?eid='.$event_id.'">Submit Change</button></th>';
	}
	echo '</tr>';
	
	
	  while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['username'] . "</td>";
	  echo "<td>" . $row['rating'] . "</td>";
	  echo "<td>" . $row['comment'] . "</td>";
	  echo "<td>" . $row['ratingdate'] . "</td>";
                      
	  if (in_array(1, $userRoles) OR in_array(2, $userRoles) OR in_array(3, $userRoles))
	  {
	  	echo '<td><input type="checkbox" name="deactivate_rating[]" value="' . $row['ratingid']. '">Deactivate';
	  }
	  echo "</tr>";
	  }
	
	echo "</table>";
	echo '</form></td>';

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
	<form class='search' id='add_comment' method='post' action='viewEvent.php?eid=$event_id'>
		<table align='center' bgcolor='282164' border='1'>
			<tr>
				<th> Submit </th>
				<th> Rating </th>
				<th> Comment </th>
			</tr>
			<tr>
				<th> <button type='submit' action='viewEvent.php?eid='$event_id'>Submit Rating</button> </th>
				<th> 	<select name='rating'>
							<option value='0'>0
							<option value='1'>1
							<option value='2'>2
							<option value='3'>3
							<option value='4'>4
							<option value='5'>5
						</select> </th>
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

