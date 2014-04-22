<?php
//File Name: createUniversity.php
//Purpose: Confirmation page for when the user completes registation. Also page where actual database inserts are made adding user to DB.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Gottfried
//Last Date Modified: 3/28/2014

//start the session
session_start();
?>


<html>


<head>
<!--header-->
<?php require 'header.php';
require 'mysqliConnect.php';
?>
<h1>Registration Submitted</h1>
</head>

<body>

<p>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

$fN = htmlspecialchars($_POST['firstname']);
$lN = htmlspecialchars($_POST['lastname']);
$mI = htmlspecialchars($_POST['middleinitial']);
$uN = htmlspecialchars($_POST['username']);
$p = htmlspecialchars($_POST['password']);
$e = htmlspecialchars($_POST['email']);
$cN = -1;
if (!empty($_POST['classnumber']))
    $cN = htmlspecialchars($_POST['classnumber']);
$universityId = 0;
$isActive = 1;

//Protect against refresh. Don't run if page refreshed.
$result = mysqli_query($dbc, "SELECT Username FROM `users` WHERE Username = '$uN'");
    $usernameCount = mysqli_num_rows($result);
    
    
    if ($usernameCount == 0)
    {
    //Check that class number is valid
        $q = "SELECT UniversityId FROM `classes` WHERE classId = $cN AND IsActive = true";
        $result = mysqli_query($dbc, $q);
        //echo $q;
        $selectCount = mysqli_num_rows($result);
        if ($selectCount == 0)
        {
           //class is not valid change appropriate values to register in public class as non-active user.
           $cN = '10001';
           $universityId = 1;
           $isActive = 0;
        }
        while ($row = mysqli_fetch_row($result))
        {
            $universityId = $row[0]; //Obtain correct UniversityId
        }
                    //Insert user into users table as active
        $q = "INSERT INTO `users`(`FirstName`,`LastName`,`MiddleInitial`,`Username`,`Password`,`Email`,`UniversityId`,`IsActive`)
    VALUES('$fN', '$lN', '$mI', '$uN', '$p', '$e', $universityId, $isActive)";
        //echo $q;
	    $r = @mysqli_query ($dbc, $q); //run query
	    if ($r) {
            //if it ran ok
            $userID = 0;
            //Determine users userId
            $result = mysqli_query($dbc, "SELECT UserId FROM `users` WHERE Username = '$uN'");
            while ($row = mysqli_fetch_row($result)) {
                $userID = $row[0];
            }
            //Add user to users-roles table
            $q = "INSERT INTO `users-roles`(`userId`, `roleId`) VALUES($userID, 4)";
            //echo $q;
            $r = @mysqli_query($dbc, $q);
            if ($r)
            {
                //Add user to users-classes table
                $q = "INSERT INTO `users-classes`(`userId`, `classId`) VALUES($userID, $cN)";
                //echo $q;
                $r = @mysqli_query($dbc, $q);
                if ($r)
                {
                    //print message:
			        echo '<h1>Thank You!</h1>
			        <p>You are now registered.</p>';
                    if ($selectCount == 0) //Send email to Public University Admin
                    {
                        echo "Trying to EMAIL!";
                       // Create the body:
			            $body = "User: $uN is requesting permission to post on the Civility Site";
			
			            // Make it no longer than 70 characters long:
			            $body = wordwrap($body, 70);
			
			            // Send the email:
			            mail('example@example.net', 'User requesting permission to post', $body, "From: civility@civility.com");
                    }
                    
		        }
                else
                {
                    //if not ok
			            echo '<h1>Error</h1>
			            <p>System error preventing Registration. Failed when adding the user to the class.</p>';
		        }
                }
                else
                {
                    echo '<h1>Error</h1>
			        <p>System error preventing Registration. Failed when assigning roles to the user.</p>';
                }
            }
            else
            {
                echo '<h1>Error</h1>
		        <p>System error preventing Registration. Failed when registering the user.</p>';
            }
	    }
        else
        {
            echo '<h1>Error</h1>
		        <p>That username already exists. This error may appear if the page is refreshed after successfully registering.</p>';
        }
    }
    mysqli_close($dbc);
?>
 
<form class="registrationsubmitted" id="registrationsubmitted" method="post" action="index.php">
<button type="submit" >Return to Home Page</button>
</form> 



</p>

</body>
</html> 
