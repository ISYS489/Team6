<?php
//start the session
session_start();
$userID = $_SESSION['userid'];
?>


<html>


<head>
<!--header-->

<?php require 'header.php';
 
//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array(); //Initialize an error array.
	$updatedInfo=false;
	//Check for a new first name
	if (empty($_POST['first_name'])) {
		$updatedInfo=true;
	}else{
		$fn = trim($_POST['first_name']);
	}
	
	//Check for a new middle initial		
	if (empty($_POST['middle_initial'])) {
		$updatedInfo=true;
	}else{
		$mi = trim($_POST['middle_initial]']);
	}
	
	//Check for a  new last name
	if (empty($_POST['last_name'])) {
	 	$updatedInfo=true;
	}else{
		$ln = trim($_POST['last_name']);
	}

	//Check for a  new email
	if (empty($_POST['email'])) {
	 	$updatedInfo=true;
	}else{
		$em = trim($_POST['email']);
	}

	//Check for a change
	if(updatedInfo) {
		//connect to the DB
		require ('mysqliConnect.php');
		
		//make the query
		$uq = "UPDATE users SET FirstName=$fn, LastName=$ln, Email=$em WHERE UserId='$userID'";
		$r = mysqli_query ($dbc, $uq); //run query
		echo $uq;
		if ($r) {//if it ran ok
		
			//print message:
			echo '<h1>Thank You!</h1>
			<p>You have updated your information.</p>';
			// Redirect User to accountSettings:
			header("location: http://brteam6.isys489.com/accountSettings.php");

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





$userQuery = "SELECT * FROM users WHERE userid='$userID'";
//$userQuery = "SELECT u.*, uc.ClassId FROM users AS u INNER JOIN users-classes AS uc USING (UserId) WHERE uc.UserId='$userID'";
$r = mysqli_query ($dbc, $userQuery); //run query

while($row = mysqli_fetch_array($r))
  {
  	//echo 'Active Course #: ' . $row['FirstName'] . '</br>';
  	//<input type="text" placeholder="Course # " name="coursenumber" autofocus /><br></br>
	//echo 'University: ' . $row['FirstName'] . '</br>';
	//<input type="text" placeholder="University " name="university" autofocus /><br></br>
	
	echo 'First Name    : ' . $row['FirstName'] . '</br>
	<input type="text" placeholder="New First Name" name="first_name" autofocus /><br></br>';
	
	echo 'Middle Initial: ' . $row['MiddleInitial'] . '</br>
	<input type="text" placeholder="New Middle Initial" name="middle_initial" autofocus /><br></br>';
	
	echo 'Last Name     : ' . $row['LastName'] . '</br>
	<input type="text" placeholder="New Last Name" name="last_name" autofocus /><br></br>';

	
	echo 'Email Address : ' . $row['Email'] . '</br>
	<input type="text" placeholder="New Email" name="email" autofocus /><br></br>';

	
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
