<?php # create an event
//performs INSERT query to add a record to the event table 
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
$ed = trim($_POST['event_description]']);
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
}

//Create Publish Date
$pd = date('Y-m-d');

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
$q = "INSERT INTO events (eventname, eventdesc, politicalpartyid, mediatypeid, newsoutletid, nameid, url, publishdate, userid) VALUES ('$en','$ed','$pp','$mt','$no','$n','$url','$pd','$uid')";
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
	   Event Name: <input type="text" size="100" name="event_name" value="<?php if(isset($_POST['event_name'])) echo $_POST['event_name']; ?>" /></br>
Event Description: <input type="text" size="100" rows="5" name="event_description" value="<?php if(isset($_POST['event_description'])) echo $_POST['event_description'];?>"/></br>
        Event URL: <input type="text" size="100"name="URL" value="<?php if(isset($_POST['URL'])) echo $_POST['URL']; ?>" /></br>

<?php require ('mysqliConnect.php');


/* multi query statement */
$keywordQuery = "SELECT MediaTypeId, MediaType FROM mediatypes;SELECT NameId, Name From names;SELECT NewsOutletId, NewsOutlet FROM newsoutlets;SELECT PoliticalPartyId, PoliticalParty FROM politicalparties";

$counter=0; // counter for drop down menu population 0=mediatype 1=name 2=newsoutlet 3=politicalparty
/* execute multi query */
if (mysqli_multi_query($dbc, $keywordQuery)) {
    do {
        /* begin corresponding select */
        if ($counter == 0) {
         	echo "Select a Media Type: ";
			echo "<select name='media_type'>";
		} else if ($counter == 1) {
		 	echo "Select a Person of Interest: ";
			echo "<select name='name'>";
		} else if ($counter == 2){
		 	echo "Select a News Outlet: ";
			echo "<select name='news_outlet'>";
		} else if ($counter == 3){
		 	echo "Select a Political Party: ";
		 	echo "<select name='political_party'>";
		} 
		echo "<option value=''></option>"; //Create a default value
        /* input corresponding values */
        if ($result = mysqli_store_result($dbc)) {
            while ($row = mysqli_fetch_row($result)) {
		         	echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";  		           
            }  
            echo "</select></br>";
        }
        
        /* increase counter for next attribute */
        if (mysqli_more_results($dbc)) {
            $counter = $counter + 1;
        }
    } while (mysqli_next_result($dbc));
}

echo "</p>";

mysqli_close($dbc);
?>

<input type="submit" name="submit" value="Create Event"/>
<br></br>
</form>