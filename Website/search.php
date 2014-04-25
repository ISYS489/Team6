<?php
//File Name: search.php
//Purpose: This page allows standard (eventwide) and advanced (based on all or one of media type, name, political party, news outlet, date ).
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 4/17/2014

//start the session
session_start();
?>


<html>


<head>

<?php include("header.php");?>


</head>

<body>
<div class="hatch">
<h1>The Search Page</h1>


<form class ="search" align="center" id="search" method="post" action="searchResults.php">

<p align="center">

<font color="yellow">Please complete one or more fields.<br></font>

<input align="center" type="text" placeholder="Event Name " name="eventname"  autofocus />
<br></br>

<input type="number" placeholder="Rating " min="0" max"5" name="rating" align="center" autofocus />
<br></br>

<input type="number" placeholder="Course # " name="coursenumber" align="center" autofocus />
<br></br>

<input type="text" placeholder="University " name="university" align="center" autofocus />
<br></br>

<font color='yellow'>
Year Range Beginning: <input type="number" name="StartYear" min="1750" max="2050" placeholder="Any">

Ending: <input type="number" name="EndYear" min="1750" max="2050" placeholder="Any">
<br></br>
  

<?php

	require ('keywordFunctions.php');

	
	//uses post variables 'media_type', 'name', 'political_party', 'news_outlet',  
	displayKeywords();
	echo "</b></font>";
?>

<button type="submit" align="center" >Search</button>
<br></br>


</p>

</form>

</div>
</body>
</html> 