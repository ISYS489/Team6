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
These are terms and conditions....
 
<form class="terms">
<input type="checkbox" name="agree" value="agree">I agree<br>
<input type="checkbox" name="disagree" value="disagree">I do not agree
</form> 


<form class="termsandconditions" id="termsandconditions" method="post" action="registrationsubmitted.php">
<button type="submit" >Submit</button>
</form> 


<button type="submit" >Submit</button>

<button type="submit" >Submit</button>



</p>

</body>
</html> 
