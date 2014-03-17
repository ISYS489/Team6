<?php
session_start();
?>
//start the session

<html>


<head>
<!--header-->

<?php require 'header.php'; ?>


</head>

<body>
<h1>Deactivate a University</h1>
<form id="deactivateUserForm" method="post">
<font color="white">Select User to Deactivate:<br/><font>
<select name="user">
<option value="1">User 1</option>
</select><br/>
<button type="submit" onclick="window.confirm('Are you sure you want to delete this University?')" >Deactivate User</button>
</form>
</body>
</html> 
