<?php
session_start();
$userID = $_SESSION['userId'];
?>

<!--
File Name: createUser.php
Purpose: Create a new user
Class: ISYS489
Instructor: Amy Buse
Author: Kyle Thompson
Last Date Modified: 3/28/2014
-->

<?php # create a user
//performs INSERT query to add a record to the user table

function isValidDateTimeString($str_dt) {//This will tell you whether or not a valid date has been passed.
    $str_dateformat = 'Y/m/d';
    $date = DateTime::createFromFormat($str_dateformat, $str_dt);
    return ($date === false ? false : true);
}

$page_title = 'CreateUser';

include ('header.php');

//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array(); //Initialize an error array.

	//Check for a user name
	if (empty($_POST['user_name']))
    {
		$errors[] = 'You forgot to enter a user name.';
	}
    else
    {
        $un = trim($_POST['user_name']);
    }
    

	if (empty($errors)) { //if there are no errors
		//connect to the DB
		require ('mysqliConnect.php');
		//make the query
		$q = "INSERT INTO users (name, IsActive) VALUES ('$un', true)";
		$r = @mysqli_query ($dbc, $q); //run query
		if ($r) {//if it ran ok

			//print message:
			echo '<h1>Thank You!</h1>
			<p>You have created a User.</p>';

		}else{ //if not ok

			echo '<h1>Error</h1>
			<p>System error preventing User creation, user may already exist.</p>';
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
<h1>Create User</h1>
<form action="createUser.php" method="post">

    <p>
        User Name:
        <input type="text" name="user_name" value="<?php if(isset($_POST['user_name'])) echo $_POST['user_name']; ?>" />

    </p>

    <input type="submit" name="submit" value="Create User" />
    <br />
</form>
