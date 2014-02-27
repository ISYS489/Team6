<?php
session_start();
?>
//start the session

<html>


<head>
<!--header-->

<?php require 'header.php'; ?>

<h1>Account Tools</h1>
</head>

<body>

<p>
<h1>Welcome to Your Account Tools</h1>

<!--link to account settings page-->
<ul class ="accountsettings">
<li><a href="accountsettings.php">Account Settings</a></li>
</ul>


<!-- student -->
<ul class ="Student">
<li><a href="">my posts</a></li>
<li><a href="">class posts</a></li>
</ul>

<!-- professor-->
<ul class ="Professor">
<li><a href="">Add Keywords</a></li>
<li><a href="CreateClass.php">Create Course </a></li>
<li><a href="">Deactivate Course </a></li>
<li><a href="">Create User</a></li>
<li><a href="">Deactivate User</a></li>
<li><a href="">View Reports</a></li>
</ul>


<!-- university admin-->
<ul class ="UniversityAdmin">
<li><a href="">Add Keywords</a></li>
<li><a href="CreateClass.php">Create Course </a></li>
<li><a href="">Deactivate Course </a></li>
<li><a href="">Create User</a></li>
<li><a href="">Deactivate User</a></li>
<li><a href="">View Reports</a></li>
</ul>

<!-- site admin -->
<ul class ="SiteAdmin">
<li><a href="">Add Keywords</a></li>
<li><a href="CreateClass.php">Create Course </a></li>
<li><a href="">Deactivate Course </a></li>
<li><a href="">Create User</a></li>
<li><a href="">Deactivate User</a></li>
<li><a href="">View Reports</a></li>
<li><a href="CreateUniversity.php">Create University</a></li>
<li><a href="">Deactivate University</a></li>
</ul>


</p>

</body>
</html> 
