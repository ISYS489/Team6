<?php # keyword functions
// this page defines functions used to display keywords


/**
* //redirects user to index for any website.
* //for this particular website the passed argument is the index.
* function redirect_user ($page = 'index.php'){
* 	//define URL
* 	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
* 	
* 	//remove any trailing slashes
* 	$url = rtrim($url, '/\\');
* 	
* 	// Add the page:
* 	$url .= '/' . $page;
* 	
* 	// Redirect User:
* 	header("location: $url");
* 	exit(); // Stops the script
* 	
* }

* function check_login($dbc, $username = '', $password = ''){
* 	
* 	$errors = array(); //creates error array
* 	
* 	//validate email adress
* 	if (empty($username)) {
* 		$errors[] = 'You forgot to enter your email address.';
* 	}else{
* 		$u = mysqli_real_escape_string($dbc, trim($username));
* 	}
* 	
* 	//validate password
* 	if (empty($password)) {
* 		$errors[] = 'You forgot to enter your password.';
* 	}else{
* 		$p = mysqli_real_escape_string($dbc, trim($password));
* 	}
* 	
* 	if (empty($errors)) { // if there are no errors
* 		
* 		//retrieve userid and first name
* 		$q = "SELECT userid, firstname FROM users WHERE username='$u' AND password=('$p')";
* 		$r = @mysqli_query ($dbc, $q);
* 		// run query
* 		
* 		//check result
* 		if (mysqli_num_rows($r) == 1){
* 			
* 			//fetch record
* 			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
* 			
* 			//return true
* 			return array(true, $row);
* 			
* 		}else{
* 			$errors[] = 'The username and password entered do not match those on file.';
* 		}
* 		
* 		//return false and errors
* 		return array(false, $errors);
* 	}
* }
*/


function displayKeywords(){
 	require ('mysqliConnect.php');
		/* multi query statement */
	$keywordQuery = "SELECT MediaTypeId, MediaType FROM mediatypes;SELECT NameId, Name From names;SELECT NewsOutletId, NewsOutlet FROM newsoutlets;SELECT PoliticalPartyId, PoliticalParty FROM politicalparties";
	
	$counter=0; // counter for drop down menu population 0=mediatype 1=name 2=newsoutlet 3=politicalparty
	/* execute multi query */
	if (mysqli_multi_query($dbc, $keywordQuery)) {
	    do {
	        /* begin corresponding select */
	        if ($counter == 0) {
	         	echo "Media Type: ";
				echo "<select name='media_type'>";
			} else if ($counter == 1) {
			 	echo "Person of Interest: ";
				echo "<select name='name'>";
			} else if ($counter == 2){
			 	echo "News Outlet: ";
				echo "<select name='news_outlet'>";
			} else if ($counter == 3){
			 	echo "Political Party: ";
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
}

?>