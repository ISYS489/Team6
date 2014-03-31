<?php # add a keyword
//performs INSERT query to add a record to the university table
session_start();
$page_title = 'Add Keyword';

include ('header.php');
?>



///display keyword form
<h1>Add Keyword</h1>
<form class ="AddKeyword" id="Add-Keyword" method="post" action="addKeyword.php">

<h2>Add Keyword here</h2>
<input type="text" placeholder="Name" name="name" autofocus />
<br></br>


<input type="text" placeholder="Media Type" name="media_type" autofocus />
<br></br>

<input type="text" placeholder="Poliitical Party" name="political_party" autofocus />
<br></br>

<input type="text" placeholder="News Outlet" name="news_outlet" autofocus />
<br></br>

<button type="submit">Login</button>
<br></br>

</form>


//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$errors = array(); //Initialize an error array.
	
	
	//Check for a keyword 
	if ((empty($_POST['name'])) && (empty($_POST['media_type'])) && (empty($_POST['political_party'])) && (empty($_POST['news_outlet']))){
		$errors[] = 'You forgot to enter a keyword.';
	}
	
	
	if (empty($errors)) { //if there are no errors
		//connect to the DB
		require ('mysqliConnect.php');
		
		
		//Check for a name
		if (!empty($_POST['name'])) {
		 
	 		$pn = trim($_POST['name']);
	 		//make the query
			$q = "INSERT INTO names (name) VALUES ('$pn')";
			$r = @mysqli_query ($dbc, $q); //run query
			if ($r) {//if it ran ok
		
				//print message:
				echo '<h1>Thank You!</h1>
				<p>You have added a name.</p>';
				
			}else{
			 
				echo '<h1>Error</h1>
				<p>System error preventing name addition, person may already exist.</p>';
			}
		
		}
		
		//Check for a media type
		if (!empty($_POST['media_type'])) {
		 
	 		$mt = trim($_POST['media_type']);
	 		//make the query
			$q = "INSERT INTO mediatypes (mediatype) VALUES ('$mt')";
			$r = @mysqli_query ($dbc, $q); //run query
			if ($r) {//if it ran ok
		
				//print message:
				echo '<h1>Thank You!</h1>
				<p>You have added a mediatype.</p>';
				
			}else{
			 
				echo '<h1>Error</h1>
				<p>System error preventing medai type addition, media type may already exist.</p>';
			}
		
		}
		
		//Check for a political party
		if (!empty($_POST['political_party'])) {
		 
	 		$pp = trim($_POST['political_party']);
	 		//make the query
			$q = "INSERT INTO politicalparties (politicalparty) VALUES ('$pp')";
			$r = @mysqli_query ($dbc, $q); //run query
			if ($r) {//if it ran ok
		
				//print message:
				echo '<h1>Thank You!</h1>
				<p>You have added a political party.</p>';
				
			}else{
			 
				echo '<h1>Error</h1>
				<p>System error preventing political party addition, political party may already exist.</p>';
			}
		
		}
		
		//Check for a news outlet
		if (!empty($_POST['news_outlet'])) {
		 
	 		$no = trim($_POST['news_outlet']);
	 		//make the query
			$q = "INSERT INTO newsoutlets (newsoutlet) VALUES ('$no')";
			$r = @mysqli_query ($dbc, $q); //run query
			if ($r) {//if it ran ok
		
				//print message:
				echo '<h1>Thank You!</h1>
				<p>You have added a news outlet.</p>';
				
			}else{
			 
				echo '<h1>Error</h1>
				<p>System error preventing news outlet addition, news outlet may already exist.</p>';
			}
		
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

echo '<h1>Add Keyword</h1> 
		<p>Current Keywords: </br>';

require ('keywordFunctions.php');

displayKeywords();

?>
</p>
<form action="addKeyword.php" method="post">

	<p>Name of Person of Interest: <input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" /></br>
	
	Media Type: <input type="text" name="media_type" value="<?php if(isset($_POST['media_type'])) echo $_POST['media_type']; ?>" /></br>
	
	Political Party: <input type="text" name="political_party" value="<?php if(isset($_POST['political_party'])) echo $_POST['political_party']; ?>" /></br>
	
	News Outlet: <input type="text" name="news_outlet" value="<?php if(isset($_POST['news_outlet'])) echo $_POST['news_outlet']; ?>" /></p>
	
    <input type="submit" name="submit" value="Add Keyword(s)"/>
	<br></br>
</form>

