<html>
<<<<<<< HEAD
<<<<<<< HEAD
<!-- included for testing purposes -->
  
=======
>>>>>>> 6088d2ca7e5483f4f48a564bbd06c3d6bdc6e96c
=======
>>>>>>> 6088d2ca7e5483f4f48a564bbd06c3d6bdc6e96c

<!-- link to style sheet -->
<link rel="stylesheet" type="text/css" href="mystyle.css">

<head>

<?php include("header.html");
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
<form class ="login" id="login-register" method="post" action="login_session.php">

<h2>Login</h2>
<input type="text" placeholder="your@email.com" name="email" autofocus />
<br></br>
<input type="text" placeholder="Password" name="password" autofocus />
<br></br>
<button type="submit">Login</button>
<br></br>
<<<<<<< HEAD
<<<<<<< HEAD
<a href="forgotusername.php">Forgot Username</a>
<br>
<a href="forgotpassword.php">Forgot Password</a>

=======
>>>>>>> 6088d2ca7e5483f4f48a564bbd06c3d6bdc6e96c
=======
>>>>>>> 6088d2ca7e5483f4f48a564bbd06c3d6bdc6e96c
<h2> If you are a new user click register</h2>
<ul class ="register">
<a href="register.php">Register</a>
<span></span>
</ul>
</form>




</body>
</html> 
