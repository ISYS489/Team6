<?php
session_start();
?>
//start the session

<html>


<head>
<!--header-->

<?php require 'header.php'; ?>

<h1>Terms and Conditions</h1>
</head>

<body>
<h2>Please read the terms and conditions before submitting your registration </h2>
<p>
These are the terms and conditions....
</p>
 
<form class="terms">
<input type="checkbox" name="agree" value="agree">I agree<br>
<input type="checkbox" name="disagree" value="disagree">I do not agree
</form> 


<form class="termsandconditions" id="termsandconditions" method="post" action="registrationsubmitted.php">
<button type="submit" >Submit</button>
</form>

</body>
</html> 
