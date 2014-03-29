<!--
File Name: createUniversity.php
Purpose: Confirmation page for when the user completes registation. Also page where actual database inserts are made adding user to DB.
Class: ISYS489
Instructor: Amy Buse
Author: Kyle Gottfried
Last Date Modified: 3/28/2014
-->
<?php
session_start();
$userID = $_SESSION['userId'];
?>
//start the session

<html>


<head>
<!--header-->
<?php require 'header.php'; ?>
<h1>Registration Submitted</h1>
</head>

<body>

<p>
Registration Submitted...
 
<form class="registrationsubmitted" id="registrationsubmitted" method="post" action="index.php">
<button type="submit" >Return to Home Page</button>
</form> 



</p>

</body>
</html> 
