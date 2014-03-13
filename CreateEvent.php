<?php # create an event
//performs INSERT query to add a record to the event table 

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
$en = trim($_POST['event_description]']);
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

//Check for a event URL
if (empty($_POST['URL'])) {
$errors[] = 'You forgot to enter a URL.';
}else{
$url = trim($_POST['URL']);
}

if (empty($errors)) { //if there are no errors
//connect to the DB
require ('mysqli_connect.php');
//make the query
$q = "INSERT INTO events (eventname, eventdescription, politicalpartyid, mediatypeid, newsoutletid, nameid, url) VALUES ('$en','$ed','$pp','$mt','$no','$n','$url')";
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


<!-- <form name="jump">
<p align="center">
<select name="menu">
<option value="URL">Text that will appear in the choices</option>
<option value="URL">Text that will appear in the choices</option>
<option value="URL">Text that will appear in the choices</option>
<option value="URL">Text that will appear in the choices</option>
</select>
<input type="button" onClick="location=document.jump.menu.options[document.jump.menu.selectedIndex].value;" value="GO">
</p>
</form> -->


<form action="CreateEvent.php" method="post">

<p>Event Name: <input type="text" name="event_name" value="<?php if(isset($_POST['event_name'])) echo $_POST['event_name']; ?>" /></br>
Event Description: <input type="text" name="event_description" value="<?php if(isset($_POST['event_description'])) echo $_POST['event_description']; ?>" /></br>
Event URL: <input type="text" name="URL" value="<?php if(isset($_POST['URL'])) echo $_POST['URL']; ?>" /></p>

<?php require ('mysqli_connect.php');

$q = "SELECT MediaTypeId FROM MediaTypes";
$r = @mysqli_query ($dbc, $q); //run query
echo "<p>";
if ($r) {//if it ran ok
	echo "<select name='MediaTypeId'>";
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	    echo '<option value=" . $row['MediaTypeId'] . ">' . $row['MediaType'] . ''</option>';}
	    
	echo "</select></br>";
}


$q = "SELECT NameId FROM names";
$r = @mysqli_query ($dbc, $q); //run query

if ($r) {//if it ran ok
	echo "<select name='NameId'>";
	while ($row = mysql_fetch_array($result)) {
	    echo "<option value=" . $row['NameID'] . ">" . $row['NameID'] . "</option>";}
	    
	echo "</select></br>";
}


$q = "SELECT newsoutletid FROM newsoutlets";
$r = @mysqli_query ($dbc, $q); //run query
	
if ($r) {//if it ran ok	
	echo "<select name='nesoutletid'>";
	while ($row = mysql_fetch_array($result)) {
	    echo "<option value=" . $row['NewsoutletID'] . ">" . $row['NewsOutletID'] . "</option>";}
	    
	echo "</select></br>";
}


$q = "SELECT politicalpartyid FROM politicalpartyid";
$r = @mysqli_query ($dbc, $q); //run query

if ($r) {//if it ran ok	
	echo "<select name='politicalpartyid'>";
	while ($row = mysql_fetch_array($result)) {
	    echo "<option value=" . $row['politicalpartyID'] . ">" . $row['politicalpartyID'] . "</option>";}
	    
	echo "</select></br>";
}
echo "</p>";
mysqli_close($dbc);
?>

<input type="submit" name="submit" value="Create Event"/>
<br></br>
</form>
