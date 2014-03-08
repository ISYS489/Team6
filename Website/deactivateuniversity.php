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
<form id="deactivateUniversityForm" method="post">
Select University to Deactivate:<br/>
<select name="university">
<option value="1">University 1</option>
</select><br/>
<button type="submit" onclick="window.confirm('Are you sure you want to delete this University?')" >Delete University</button>
</form>
</body>
</html> 
