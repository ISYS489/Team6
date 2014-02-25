<?php # create an event
//performs INSERT query to add a record to the event table 

$page_title = 'CreateEvent';

include ('header.html');

//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$errors = array(); //Initialize an error array.

//Check for a event name
if (empty($_POST['event_name'])) {
$errors[] = 'You forgot to enter a event name.';
}else{
$un = trim($_POST['event_name']);
}

//Check for a event start date
if (empty($_POST['start_date'])) {
$errors[] = 'You forgot to enter a start date.';
}else{
$sd = trim($_POST['start_date']);
}

//Check for a event end date
if (empty($_POST['end_date'])) {
$errors[] = 'You forgot to enter a start date.';
}else{
$ed = trim($_POST['end_date']);
}

if (empty($errors)) { //if there are no errors
//connect to the DB
require ('mysqli_connect.php');
//make the query
$q = "INSERT INTO events (name, startdate, enddate) VALUES ('$un','$sd','$ed')";
$r = @mysqli_query ($dbc, $q); //run query
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
<form action="CreateEvent.php" method="post">

<p>Event Name: <input type="text" name="event_name" value="<?php if(isset($_POST['event_name'])) echo $_POST['event_name']; ?>" /></p>
<p>Start Date: <input type="text" name="start_date" placeholder="YYYYMMDD" value="<?php if(isset($_POST['start_date'])) echo $_POST['start_date']; ?>" /></p>
<p>End Date: <input type="text" name="end_date" placeholder="YYYYMMDD" value="<?php if(isset($_POST['end_date'])) echo $_POST['end_date']; ?>" /></p>
<input type="submit" name="submit" value="Create Event"/>
<br></br>
</form>