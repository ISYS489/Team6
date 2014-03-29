<!--
File Name: createUniversity.php
Purpose: Provides links to all the action pages that a user can access.
Class: ISYS489
Instructor: Amy Buse
Author: Kyle Gottfried
Last Date Modified: 3/28/2014
-->
<?php
session_start();
$userID = $_SESSION['userId'];
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
<ul class ="accountSettings">
<li><a href="accountSettings.php">Account Settings</a></li>
</ul>


<!-- student -->
<ul class ="Student">
<li><a href="reports.php">my posts</a></li>
<li><a href="reports.php">class posts</a></li>
</ul>

<!-- professor-->
<ul class ="Professor">
<li><a href="addKeyword.php">Add Keywords</a></li>
<li><a href="createClass.php">Create Course </a></li>
<li><a href="deactivateCourse.php">Deactivate Course </a></li>
<li><a href="createUser.php">Create User</a></li>
<li><a href="deactivateUser.php">Deactivate User</a></li>
<li><a href="reports.php">View Reports</a></li>
</ul>


<!-- university admin-->
<ul class ="UniversityAdmin">
<li><a href="addKeyword.php">Add Keywords</a></li>
<li><a href="createClass.php">Create Course </a></li>
<li><a href="deactivateCourse.php">Deactivate Course </a></li>
<li><a href="createUser.php">Create User</a></li>
<li><a href="deactivateUser.php">Deactivate User</a></li>
<li><a href="reports.php">View Reports</a></li>
</ul>

<!-- site admin -->
<ul class ="SiteAdmin">
<li><a href="addKeyword.php">Add Keywords</a></li>
<li><a href="createClass.php">Create Course </a></li>
<li><a href="deactivateCourse.php">Deactivate Course </a></li>
<li><a href="createCourse.php">Create User</a></li>
<li><a href="deactivateUser.php">Deactivate User</a></li>
<li><a href="reports.php">View Reports</a></li>
<li><a href="createUniversity.php">Create University</a></li>
<li><a href="deactivateUniversity.php">Deactivate University</a></li>
</ul>


</p>

</body>
</html> 
