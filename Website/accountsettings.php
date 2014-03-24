<?php
session_start();
?>
//start the session

<html>



<head>


<?php require 'header.php'; ?>

<h1>Account Settings</h1>
</head>

<body>
<p>
<h2>Account Information</h2>

<font color="white">

<?php require ('mysqli_connect.php');

$userID = $_SESSION['userid'];

$userQuery = "SELECT * FROM users WHERE userid='$userID'";
$r = @mysqli_query ($dbc, $userQuery); //run query

while($row = mysqli_fetch_array($r))
  {
  	//echo 'Active Course #: ' . $row['FirstName'] . '</br>';
	//echo 'University: ' . $row['FirstName'] . '</br>';
	echo 'First Name    : ' . $row['FirstName'] . '</br>';
	echo 'Middle Initial: ' . $row['MiddleInitial'] . '</br>';
	echo 'Last Name     : ' . $row['LastName'] . '</br>';
	echo 'Email Address : ' . $row['email'] . '</br>';
	echo 'Date Created  : ' . $row['CreationDate'] . '</br>';
	echo 'Activity Status: ' . $row['IsActive'] . '</br>';
  }
	



mysqli_close($dbc);

?>
</font>


</p>

<h2>Edit Account Settings</h2>
<ul class ="editaccountsettings">
<li><a href="editaccountsettings.php">Edit Account Settings</a></li>
</ul>


</body>
</html> 
