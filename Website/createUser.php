<?php
session_start();
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

	//Assign UniversityId
	$universityId = trim($_POST['UniversityId']);
	
	//Assign ClassId
	$classId = trim($_POST['ClassId']);
	
	//Assign Role
	$roleId = trim($_POST['RoleId']);
	
	//Check for a user name
	if (empty($_POST['FirstName']))
    {
		$errors[] = 'You forgot to enter a first name.';
	}
    else
    {
        $firstName = trim($_POST['FirstName']);
    }
	
    
    //Check for last name
    if (empty($_POST['LastName'])) {
        $errors[] = 'You forgot to enter a last name.';
    }else
    {
    	$lastName = trim($_POST['LastName']);
    }
    

    //Check for a middle initial
    if (empty($_POST['MiddleInitial'])) {
        $errors[] = 'You forgot to enter a class name.';
    }else{
        $middleInitial = trim($_POST['MiddleInitial']);
    }

    //Check for username
    if (empty($_POST['Username'])) {
        $errors[] = 'You forgot to enter a username.';
    }else{
        $username = trim($_POST['Username']);
    }
    
    //Check for password
 if (empty($_POST['Password'])) {
        $errors[] = 'You forgot to enter a password.';
    }else{
        $password = trim($_POST['Password']);
    }
	


    //Check for a class end date
    if (empty($_POST['Email'])) {
        $errors[] = 'You forgot to enter an email.';
    }else{
        $email = trim($_POST['Email']);
    }
	
		    if (empty($_POST['IsActive'])) {
        $errors[] = 'You forgot to mark user as active';
    }else{
        $isActive = trim($_POST['IsActive']);
    }


	
	
	
	
    

	if (empty($errors)) { //if there are no errors

		//make the query
		$q = "INSERT INTO users (FirstName, LastName, MiddleInitial, Username, Password, Email, UniversityId, IsActive) VALUES ('$firstName', '$lastName', '$middleInitial', '$username', '$password', '$email', '$universityid', '$isActive' )";
		$r = @mysqli_query ($dbc, $q); //run query
		if ($r) {//if it ran ok
			$q = "SELECT UserId FROM users WHERE Username = '$un' LIMIT 1"
			$r = @mysqli_query($dbc, $q);
			while ($row = mysqli_fetch_row($result))
				{
                    			$userId = $row[0];
                		}
                	$q = "INSERT INTO `users-classes`(`ClassId`, `UserId`) VALUES ($userId,$classId)"
			$r = @mysqli_query($dbc, $q);
			if ($r)
			{
				$q = "INSERT INTO `users-roles`(`UserId`, `RoleId`) VALUES ($userId,$roleId)";
				//print message:
				echo '<h1>Thank You!</h1>
				<p>You have created a User.</p>';
			}
			

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
	<select name="UniversityId">
	 	<?php

            $result = mysqli_query($dbc,'SELECT UniversityId, Name FROM universities WHERE isActive = true');

            while ($row=mysqli_fetch_array($result))
            {
                echo '<option value=' . htmlspecialchars($row['UniversityId']) . '>'
                . htmlspecialchars($row['Name'])
                . '</option>';
            }
        	?>
	</select>
        <!--<input type="text" name="UniversityId" value="<?php // if(isset($_POST['UniversityId'])) echo $_POST['UniversityId']; ?>" />-->
		</li>
		
		<li>
		Class Id:
	<select name = "ClassId">
	<?php

            $result = mysqli_query($dbc,'SELECT UniversityId, Name FROM classes WHERE isActive = true');

            while ($row=mysqli_fetch_array($result))
            {
                echo '<option value=' . htmlspecialchars($row['ClassId']) . '>'
                . htmlspecialchars($row['Name'])
                . '</option>';
            }
        	?>
	</select>
	</li>
	
		User Type:
	<select name = "UserType">
	<?php

            $result = mysqli_query($dbc,'SELECT RoleId, RoleName FROM classes WHERE isActive = true');

            while ($row=mysqli_fetch_array($result))
            {
                echo '<option value=' . htmlspecialchars($row['RoleId']) . '>'
                . htmlspecialchars($row['RoleName'])
                . '</option>';
            }
        	?>
	</select>
	
	<!--<input type="text" name="ClassId" value="<?php // if(isset($_POST['ClassId'])) echo $_POST['UniversityId']; ?> />-->
		
<li>		  Is this user active type 1 for yes and 0 for no:
        <input type="text" name="IsActive" value="<?php if(isset($_POST['IsActive'])) echo $_POST['IsActive']; ?>" />
		</li>

    

    <input type="submit" name="submit" value="Create User" />
    <br />
	</p>
</form>
