<?php # create an event
//File Name: createEvent.php
//Purpose: This page is used to insert an event into the DB.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 3/30/2014
//performs INSERT query to add a record to the event table 

//session
session_start();
$page_title = 'CreateEvent';

include ('header.php');

//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$errors = array(); //Initialize an error array.
	
	//Check for a event name
	if (empty($_POST['event_name'])) {
	$errors[] = 'You forgot to enter a event name.';
	}else{
	$en = trim($_POST['event_name']);
	}
	
	//Check for a event description		
	if (empty($_POST['event_description'])) {
	$errors[] = 'You forgot to enter a event description.';
	}else{
	$ed = trim($_POST['event_description']);
	}
	
	//Check for a political party
	if (empty($_POST['political_party'])) {
	$errors[] = 'You forgot to enter a political party.';
	}else{
	$pp = trim($_POST['political_party']);
	}
	
	//Check for a event media type
	if (empty($_POST['media_type'])) {
	$errors[] = 'You forgot to enter a media type.';
	}else{
	$mt = trim($_POST['media_type']);
	}
	
	//Check for a event news outlet
	if (empty($_POST['news_outlet'])) {
	$errors[] = 'You forgot to enter a news outlet.';
	}else{
	$no = trim($_POST['news_outlet']);
	}
	
	//Check for a event person of interest
	if (empty($_POST['name'])) {
	$errors[] = 'You forgot to enter a name.';
	}else{
	$n = trim($_POST['name']);
	}
	
	//Check for an event URL
	if (empty($_POST['URL'])) {
		$errors[] = 'You forgot to enter a URL.';
	}else{
		$url = trim($_POST['URL']);
		if (strpos($url,'http') == false) {
	    	$url = "http://" . $url;
		}
	}

	//Check for an event date
	if (empty($_POST['Date'])) {
	$errors[] = 'You forgot to enter a Date.';
	}else{
	$edate = trim($_POST['Date']);
	}
	
	//Create Publish Date
	$pd = date("Y-m-d H:i:s");
	
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
		$q = "INSERT INTO events (eventname, eventdesc, politicalpartyid, mediatypeid, newsoutletid, nameid, url, publishdate, userid, dateofevent) VALUES ('$en','$ed','$pp','$mt','$no','$n','$url','$pd','$uid','$edate')";
		$r = mysqli_query ($dbc, $q); //run query
		
		if ($r) {//if it ran ok
		
			//print message:
			echo '<h1>Thank You!</h1>
			<p>You have created a Event.</p>';

		}else{ //if not ok
	
			echo '<h1>Error</h1>
			<p>System error preventing Event creation, Event may already exist.</p>';
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
<h1>Create Event</h1>

<form action="createEvent.php" method="post">

<p>
	   Event Name: <input type="text" size="100" maxlength="50" name="event_name" value="<?php if(isset($_POST['event_name'])) echo $_POST['event_name']; ?>" /></br>
Event Description: <input type="text" size="100" maxlength="1000" rows="5" name="event_description" value="<?php if(isset($_POST['event_description'])) echo $_POST['event_description'];?>"/></br>
        Event URL: <input type="text" size="100" maxlength="1000" name="URL" value="<?php if(isset($_POST['URL'])) echo $_POST['URL']; ?>" /></br>
        Date of Occurance: <input type="date" name="Date" value="<?php if(isset($_POST['Date'])) echo $_POST['Date']; ?>" /></br>

<?php require ('mysqliConnect.php');
	  require ('keywordFunctions.php');
	  
	

displayKeywords();


mysqli_close($dbc);
?>

<input type="submit" name="submit" value="Create Event"/>
<br></br>
</form>
