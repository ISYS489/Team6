<?php
session_start();
?>
//start the session

<html>


<head>
<!--header-->

<?php require 'header.php';
 
//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$errors = array(); //Initialize an error array.

//Check for a new first name
if (empty($_POST['first_name'])) {
$errors[] = 'You forgot to enter a first name.';
}else{
$fn = trim($_POST['first_name']);
}

//Check for a event 		
if (empty($_POST['middle_initial'])) {
$errors[] = 'You forgot to enter a middle initial.';
}else{
$mi = trim($_POST['middle_initial]']);
}

//Check for a last name
if (empty($_POST['last_name'])) {
$errors[] = 'You forgot to enter a last name.';
}else{
$pp = trim($_POST['last_name']);
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

$userID = $_SESSION['userid'];

$userQuery = "SELECT * FROM users WHERE userid='$userID'";
$r = @mysqli_query ($dbc, $userQuery); //run query

while($row = mysqli_fetch_array($r))
  {
  	//echo 'Active Course #: ' . $row['FirstName'] . '</br>';
  	//<input type="text" placeholder="Course # " name="coursenumber" autofocus /><br></br>
	//echo 'University: ' . $row['FirstName'] . '</br>';
	//<input type="text" placeholder="University " name="university" autofocus /><br></br>
	
	echo 'First Name    : ' . $row['FirstName'] . '</br>
	<input type="text" placeholder="New First Name" name="firstname" autofocus /><br></br>';
	
	echo 'Middle Initial: ' . $row['MiddleInitial'] . '</br>
	<input type="text" placeholder="New Middle Initial" name="middleinitial" autofocus /><br></br>';
	
	echo 'Last Name     : ' . $row['LastName'] . '</br>
	<input type="text" placeholder="New Last Name" name="lastname" autofocus /><br></br>';

	
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
