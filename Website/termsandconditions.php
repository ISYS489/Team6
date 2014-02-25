<html>
<!-- included for testing purposes -->

<ul class ="nav">
<li><a href="index.php">Home</a></li>
<li><a href="eventlist.php">Event List</a></li>
<li><a href="search.php">Search Events</a></li>
<li><a href="http://www.ferris.edu/pep/">PEP Page</a></li>
<li><a href="login.php">Login/Register</a></li>
<li><a href="about.php">About</a></li>
<li><a href="accounttools.php">Account Tools</a></li>
</ul>

<!-- link to style sheet -->
<link rel="stylesheet" type="text/css" href="mystyle.css">

<head>
<!--header-->
<?php require 'header.php'; ?>
<h1>Terms and Conditions</h1>
</head>

<body>
<h2>Please read the terms and conditions before submitting your registration </h2>
<p>
These are terms and conditions....
 
<form class="terms">
<input type="checkbox" name="agree" value="agree">I agree<br>
<input type="checkbox" name="disagree" value="disagree">I do not agree
</form> 
<button type="submit" >Submit</button>


</p>

</body>
</html> 
