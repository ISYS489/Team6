<html>

<!-- link to style sheet -->
<link rel="stylesheet" type="text/css" href="mystyle.css">

<head>

<?php include("header.html");?>

</head>
<body>

<h1>Login Or Register</h1>
<form class ="login" id="login-register" method="post" action="index.php">

<h2>Login</h2>
<input type="text" placeholder="your@email.com" name="email" autofocus />
<br></br>
<input type="text" placeholder="Password" name="password" autofocus />
<br></br>
<button type="submit">Login</button>
<br></br>
<h2> If your a new user click register</h2>
<ul class ="register">
<a href="register.php">Register</a>
<span></span>
</ul>
</form>




</body>
</html> 