<?php
session_start();
?>
//start the session

<html>


<head>

<?php require 'header.php'; 
require 'mysqliConnect.php';
?>




				
<h1>Forgot Password</h1>
</head>

<body>
<h2></h2>
<p>
<form name="forgot" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
<p><label for="username">Username:</label>
<input name="username" type="text" value="" />
</p>
<input type="submit" name="submit" value="submit"/>
<input type="reset" name="reset" value="reset"/>
</form>


<?php
if(isset($_POST['submit']))
{


$username = $_POST['username'];
$sql="SELECT Email, Password FROM `users` WHERE `username` ='$username'";
$query = mysqli_query($dbc, $sql);

		
		
if(!$query) 
    {
    die(mysqli_error());
    }
    
if(isset($_POST['submit']))
    {
$row = mysqli_fetch_array($query);
$email=$row['Email'];
$p = $row['Password'];
$subject="team 6 - Your password is shown below";
$header="From: brteam6.isys489.com";
$message= $p;
$note="An Email Containing the password has been sent to your email";
mail($email, $subject, $message, $header);  


echo "<table border='1' name='forgottable'>
<tr>
<th>Message</th>
</tr>";

echo "<tr>"; 
echo "<td>" . $note . "</td>";
echo "</tr>";
    }
else 
    {
    echo("no such login in the system. please try again.");
    }
} 	

?>
</table>


</p>

</body>
</html> 
