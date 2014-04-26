<?php
//File Name: forgotUsername.php
//Purpose: emails username to user.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Thompson
//Last Date Modified: 3/28/2014

//start the session
session_start();
?>


<html>


<head>
<!--header-->

<?php require 'header.php'; 
require '../mysqli_connect.php';
?>

<h1>Forgot Username</h1>
</head>

<body>
<div class="fergotuser">
<p>

<form name="forgot" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
<label for="email">Email:</label>
<input name="email" type="text" value="" />

<input type="submit" name="submit" value="submit"/>
<input type="reset" name="reset" value="reset"/>
</form>


<?php
if(isset($_POST['submit']))
{


$email = $_POST['email'];
$sql="SELECT Email, username FROM `users` WHERE `email` ='$email'";
$query = mysqli_query($dbc, $sql);

		
		
if(!$query) 
    {
    die(mysqli_error());
    }
    
if(isset($_POST['submit']))
    {
$row = mysqli_fetch_array($query);
$email=$row['Email'];
$u = $row['username'];
$subject="team 6 - Username is displayed below";
$header="From: brteam6.isys489.com";
$message= $u;
$note="An Email Containing the username has been sent to your email";
mail($email, $subject, $message, $header);  


echo "<table border='1'>
<tr>
<th>Message</th>
</tr>";

echo "<tr>"; 
echo "<td>" . $note . "</td>";
    }
else 
    {
    echo("no such email in the system. please try again.");
    }
} 	

?>



</p>
</div>
</body>
</html> 
