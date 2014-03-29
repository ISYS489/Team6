<?php
session_start();
?>
//start the session

<html>


<head>

<?php include("header.php");
// print any error messages
if (isset($errors) && !empty($errors)) {
	echo '<h1> Error! </h1>
	<p> The follwing error(s) occurred:<br />';
	foreach ($errors as $msg){
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}


?>

</head>
<body>
///display login form
<h1>Login Or Register</h1>
<form class ="login" id="login-register" method="post" action="login.php">

<h2>Login</h2>
<input type="text" placeholder="Username" name="username" autofocus />
<br></br>
<input type="password" placeholder="Password" name="password" autofocus />
<br></br>
<button type="submit">Login</button>
<br></br>

<a href="forgotUsername.php">Forgot Username</a>
<br>
<a href="forgotPassword.php">Forgot Password</a>

<h2> If you are a new user click register</h2>
<ul class ="register">
<a href="register.php">Register</a>
<span></span>
</ul>
</form>




</body>
</html> 
