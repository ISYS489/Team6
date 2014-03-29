<?php
session_start();
?>
//start the session

<html>


<head>

<?php include("header.php");?>

</head>
<body>

<h1>Register Here</h1>
<form class ="login" id="login-register" method="post" action="termsAndConditions.php">
<h2>New User Register Here</h2>
<input type="text" placeholder="First Name" name="firstname" autofocus />
<br></br>
<input type="text" placeholder="Last Name" name="lastname" autofocus />
<br></br>
<input type="text" placeholder="Middle Initial" name="middleinitial" autofocus />
<br></br>
<input type="text" placeholder="Username" name="username" autofocus />
<br></br>
<input type="password" placeholder="Password" name="password" autofocus />
<br></br>
<input type="password" placeholder="Retype Password" name="password2" autofocus />
<br></br>
<input type="text" placeholder="Email Address" name="email" autofocus />
<br></br>
<input type="text" placeholder="Course Number" name="coursenumber" autofocus />
<br></br>
<button type="submit" >Register</button>
<span></span>

</form>


</body>
</html> 
