<?php
//File Name: accountSettings.php
//Purpose: This page displays information on record for a logged in user.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 5/3/2014
//

//start the session
session_start();
?>

<html>

<head>

<?php require 'header.php'; ?>

<h1>Account Information</h1>
</head>

<body>
<center>

<p>
	<font color="white" >
		<?php
		
		//Import SQL connection code
		require ('../mysqli_connect.php');
		
			$userID = $_SESSION['userid'];
			
			//Retreive information on user.
			$userQuery = "SELECT * FROM users WHERE userid='$userID'";
			$r = @mysqli_query ($dbc, $userQuery); //run query
			
			//Echo user information to website
			while($row = mysqli_fetch_array($r))
			  {
			  	//echo 'Active Course #: ' . $row['FirstName'] . '</br>';
				//echo 'University: ' . $row['FirstName'] . '</br>';
				echo 'Name    : ' . $row['FirstName'] . ' ' . $row['MiddleInitial'] . '. ' . $row['LastName'] . '</br>';
				echo 'Email Address : ' . $row['Email'] . '</br>';
				echo 'Date Created  : ' . $row['CreationDate'] . '</br>';
				echo 'Activity Status: ';
				if ($row['IsActive']){
					echo 'Active';
				} else {
					echo 'Inactive';
				}
				echo'</br>';
			  }
				
			mysqli_close($dbc);
		?>
	</font>
</p>
</center>


<ul class ="accountSettings">
<a href="editAccountSettings.php"><h2>Edit Account Information</h2></a>
</ul>

</body>
</html> 
