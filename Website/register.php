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
<form class ="login" id="login-register" method="post" action="termsandconditions.php">
<h2>New User Register Here</h2>
<input type="text" placeholder="First Name" name="firstname" autofocus />
<br></br>
<input type="text" placeholder="Last Name" name="lastname" autofocus />
<br></br>
<button type="submit" >Register</button>
<span></span>

</form>


</body>
</html> 
