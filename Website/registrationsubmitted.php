<?php
session_start();
?>
//start the session

<html>


<head>
<!--header-->
<?php require 'header.php'; ?>
<h1>Registration Submitted</h1>
</head>

<body>

<p>
Submitted...
 
<form class="registrationsubmitted" id="registrationsubmitted" method="post" action="index.php">
<button type="submit" >Submit</button>
</form> 



</p>

</body>
</html> 
