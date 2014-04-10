<?php
//File Name: editAccountSettings.php
//Purpose: This page allows a user to edit his or her account in the DB.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 4/9/2014

//start the session
session_start();
$userID = $_SESSION['userid'];
?>


<html>


<head>
<!--header-->

<?php require 'header.php';

$updateString = ""; //stores the variables to update 

//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array(); //Initialize an error array.
	$updatedInfo=false;
	$updateString = ""; //stores the variables to update
	
	//Check for a new first name
	if (!empty($_POST['first_name'])) {
		
		$updatedInfo=true;
		$fn = trim($_POST['first_name']);
		$updateString= $updateString . "FirstName='$fn'";
		
	}
	
	//Check for a new middle initial		
	if (!empty($_POST['middle_initial'])) {
	 
	 	$updatedInfo=true;
		$mi = trim($_POST['middle_initial']);
		echo $mi;
		if ($updateString != ""){ ////if there is already a field entered, add a comma
			$updateString= $updateString .", ";
		}
		$updateString= $updateString . "MiddleInitial='$mi'";
		
	}
	
	//Check for a  new last name
	if (!empty($_POST['last_name'])) {
	 	$updatedInfo=true;
		$ln = trim($_POST['last_name']);
		if ($updateString != ""){ ////if there is already a field entered, add a comma
			$updateString= $updateString .", ";
		}
		$updateString= $updateString . "LastName='$ln'";
		
	}

	//Check for a  new email
	if (!empty($_POST['email'])) {
	 	$updatedInfo=true;
		$em = trim($_POST['email']);
		if ($updateString != ""){ ////if there is already a field entered, add a comma
			$updateString= $updateString .", ";
		}
		$updateString= $updateString . "email='$em'";
		
	}
	
	//Check for a  new password
	if (!empty($_POST['password'])&&!empty($_POST['repassword'])) {
		$pw = trim($_POST['password']);
		$rpw = trim($_POST['repassword']);
		//Check that passwords match
		if ($pw == $rpw){
		 	$updatedInfo=true;
			if ($updateString != ""){ ////if there is already a field entered, add a comma
			$updateString= $updateString .", ";
			}
			$updateString= $updateString . "password='$pw'";
		}
		
		
	}

	//Check for a change
	if(updatedInfo) {
		//connect to the DB
		require ('mysqliConnect.php');
		
		//make the query
		$uq = "UPDATE users SET " . $updateString .  " WHERE UserId='$userID'";
		$r = mysqli_query ($dbc, $uq); //run query
	
		if ($r) {//if it ran ok
		
			//print message:
			echo '<h1>Thank You!</h1>
			<p>You have updated your information.</p>';
	

		}else{ //if not ok
	
			echo '<h1>Error</h1>
			<p>System error preventing update.</p>';
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


<h1>Edit Account</h1>
</head>



<body>



<p>
<h1>Edit Your Account Information</h1>

<!-- needs to be changed -->

<form class ="search" id="search" method="post" action="editAccountSettings.php">

<?php require ('mysqliConnect.php');


//$userQuery = "SELECT * FROM users WHERE userid='$userID'";
$userQuery = "SELECT users.*, `users-classes`.ClassId FROM users LEFT OUTER JOIN `users-classes` ON users.userid = `users-classes`.userid WHERE users.userid='$userID'";


$r = mysqli_query ($dbc, $userQuery); //run query

while($row = mysqli_fetch_array($r))
  {
  	//echo 'Active Course #: ' . $row['FirstName'] . '</br>';
  	//<input type="text" placeholder="Course # " name="coursenumber" autofocus /><br></br>
	//echo 'University: ' . $row['FirstName'] . '</br>';
	//<input type="text" placeholder="University " name="university" autofocus /><br></br>
	echo 'Current Course ID    : ' . $row['ClassId'] . '</br>
	<input type="text" placeholder="New Course ID" name="first_name" autofocus /><br></br>';
	
	echo 'First Name    : ' . $row['FirstName'] . '</br>
	<input type="text" placeholder="New First Name" name="first_name" autofocus /><br></br>';
	
	echo 'Middle Initial: ' . $row['MiddleInitial'] . '</br>
	<input type="text" placeholder="New Middle Initial" name="middle_initial" autofocus /><br></br>';
	
	echo 'Last Name     : ' . $row['LastName'] . '</br>
	<input type="text" placeholder="New Last Name" name="last_name" autofocus /><br></br>';

	
	echo 'Email Address : ' . $row['Email'] . '</br>
	<input type="text" placeholder="New Email" name="email" autofocus /><br></br>';
	
	echo 'New Password: <br>
	<input type="password" placeholder="New Password" name="password" autofocus /><br></br>';
	
	echo 'Re-Type New Password: <br>
	<input type="password" placeholder="New Password" name="repassword" autofocus /><br></br>';

	
	echo 'Date Created  : ' . $row['CreationDate'] . '</br>';
	

	
	echo 'Activity Status: ' . $row['IsActive'] . '</br>';

	
  }
	



mysqli_close($dbc);





?>


<button type="submit">Submit Changes</button>
<br></br>

</p>

</body>
</html> 
