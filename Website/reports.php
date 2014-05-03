<?php
//File Name: report.php
//Purpose: Displays reporting options.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 4/13/2014

//start the session
session_start();
?> 

<html>

<head>
	<?php
		//display header info
		require 'header.php';
	?>
	
	<h1>Welcome to the Report Page</h1>
</head>

<body>
<div class="expandOpen">
<div id="reportsdiv">
<p>


<!--displays links to different reports-->
<br>
<a href='viewUserReports.php'>View User Report</a><br><br>
<a href='viewRatingReports.php'>View Rating Report</a><br><br>
<a href='viewClassReports.php'>View Class Report</a><br><br>
<br>






</p>
</div>
</div>
</body>
</html> 
