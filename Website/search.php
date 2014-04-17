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

<h1>The Search Page</h1>

<p align="center">
<form class ="search" align="center" id="search" method="post" action="searchResults.php">


<h2 align="center" >Search</h2>

<input align="center" type="text" placeholder="Event Name " name="eventname"  autofocus />
<br></br>

<input type="text" placeholder="Rating " name="rating" align="center" autofocus />
<br></br>

<input type="text" placeholder="Course # " name="coursenumber" align="center" autofocus />
<br></br>

<input type="text" placeholder="University " name="university" align="center" autofocus />
<br></br>

<?php

	require ('keywordFunctions.php');

	//uses post variables 'media_type', 'name', 'political_party', 'news_outlet',  
	displayKeywords();
?>

<button type="submit" align="center" >Search</button>
<br></br>




</form>
</p>

</body>
</html> 