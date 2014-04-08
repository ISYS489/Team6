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

$whatevers = $_GET['userid'];


//performs INSERT query to add a record to the user table

//function isValidDateTimeString($str_dt) {//This will tell you whether or not a valid date has been passed.
  //  $str_dateformat = 'Y/m/d';
    //$date = DateTime::createFromFormat($str_dateformat, $str_dt);
    //return ($date === false ? false : true);


$page_title = 'CreateUser';

include ('header.php');
require 'mysqliConnect.php';

//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array(); //Initialize an error array.

	//Check for a user name
	if (empty($_POST['FirstName']))
    {
		$errors[] = 'You forgot to enter a first name.';
	}
    else
    {
        $un = trim($_POST['FirstName']);
    }
	
    
    //Check for university id
    if (empty($_POST['LastName'])) {
        $errors[] = 'You forgot to enter a last name.';
    }else
    {
    	$um = trim($_POST['LastName']);
    }
    

    //Check for a class name
    if (empty($_POST['MiddleInitial'])) {
        $errors[] = 'You forgot to enter a class name.';
    }else{
        $uo = trim($_POST['MiddleInitial']);
    }

    //Check for a class start date
    if (empty($_POST['Username'])) {
        $errors[] = 'You forgot to enter a username.';
    }else{
        $up = trim($_POST['Username']);
    }
 if (empty($_POST['Password'])) {
        $errors[] = 'You forgot to enter a password.';
    }else{
        $uq = trim($_POST['Password']);
    }
	


    //Check for a class end date
    if (empty($_POST['Email'])) {
        $errors[] = 'You forgot to enter an email.';
    }else{
        $ur = trim($_POST['Email']);
    }
	
		    if (empty($_POST['UniversityId'])) {
        $errors[] = 'You forgot to enter a university id.';
    }else{
        $us = trim($_POST['UniversityId']);
    }
	
	    if (empty($_POST['CreationDate'])) {
        $errors[] = 'You forgot to enter a creation date.';
    }else{
        $ut = trim($_POST['CreationDate']);
    }
	
		    if (empty($_POST['IsActive'])) {
        $errors[] = 'You forgot to mark user as active';
    }else{
        $uu = trim($_POST['IsActive']);
    }


	
	
	
	
    

	if (empty($errors)) { //if there are no errors

		//make the query
		$q = "INSERT INTO users (UserId, FirstName, LastName, MiddleInitial, Username, Password, Email, UniversityId, CreationDate, IsActive) VALUES ('$whatevers ++1', '$un', '$um', '$uo', '$up', '$uq', '$ur', '$us', '$ut', '$uu' )";
		$r = @mysqli_query ($dbc, $q); //run query
		if ($r) {//if it ran ok

			//print message:
			echo '<h1>Thank You!</h1>
			<p>You have created a User.</p>';

		}
	

		

	else {

		echo '<h1>Error!</h1>
		<p>The following error(s) occurred:<br />';
		foreach ($errors as $msg) { //print each
			echo "<p>$msg</p>";
		}
		echo '</p><p>Please try again.</p>';

		}
		
		mysqli_close($dbc);
}
}

?>
<h1>Create User</h1>
<form id="createuser" action="createUser.php" method="post">

    <p>
       <ul>
<li>	   First Name:
        <input type="text" name="FirstName" value="<?php if(isset($_POST['FirstName'])) echo $_POST['FirstName']; ?>" />
		</li>
		
	<li>	 Last Name:
        <input type="text" name="LastName" value="<?php if(isset($_POST['LastName'])) echo $_POST['LastName']; ?>" />
		</li>
		
	<li>	  Middle Initial:
        <input type="text" name="MiddleInitial" value="<?php if(isset($_POST['MiddleInitial'])) echo $_POST['MiddleInitial']; ?>" />
		</li>
		
<li>		 User Name:
        <input type="text" name="Username" value="<?php if(isset($_POST['Username'])) echo $_POST['Username']; ?>" />
		</li>
		
	<li>	  Password:
        <input type="text" name="Password" value="<?php if(isset($_POST['Password'])) echo $_POST['Password']; ?>" /> 
</li>
		
<li>		Email:
        <input type="text" name="Email" value="<?php if(isset($_POST['Email'])) echo $_POST['Email']; ?>" />
		</li>
		
<li>		  University Id:
        <input type="text" name="UniversityId" value="<?php if(isset($_POST['UniversityId'])) echo $_POST['UniversityId']; ?>" />
		</li>
		
<li>		 Creation Date:
        <input type="text" name="CreationDate" value="<?php if(isset($_POST['CreationDate'])) echo $_POST['CreationDate']; ?>" />
		</li>
		
<li>		  Is this user active type 1 for yes and 0 for no:
        <input type="text" name="IsActive" value="<?php if(isset($_POST['IsActive'])) echo $_POST['IsActive']; ?>" />
		</li>

    

    <input type="submit" name="submit" value="Create User" />
    <br />
	</p>
</form>
