<?php
//File Name: search.php
//Purpose: This page allows standard (eventwide) and advanced (based on all or one of media type, name, political party, news outlet, date ).
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 4/5/2014

//start the session
session_start();
?>


<html>


<head>

<?php include("header.php");?>


</head>

<body>

<h1>The Search Page</h1>

<p>
<form class ="search" id="search" method="post" action="searchResults.php">

<h2>Enter Search Criteria Here</h2>

<input type="text" placeholder="Search" name="search" autofocus />
<br></br>

<button type="submit">Search</button>
<br></br>

<h2> Advanced Search</h2>

<?php
	
	require ('keywordFunctions.php');
	
	//uses post variables 'media_type', 'name', 'political_party', 'news_outlet',  
	displayKeywords();
?>

<input type="text" placeholder="Event Name " name="eventname" autofocus />
<br></br>

<input type="text" placeholder="Rating " name="rating" autofocus />
<br></br>

<input type="text" placeholder="Media Type " name="mediatype" autofocus />
<br></br>

<input type="text" placeholder="Course # " name="coursenumber" autofocus />
<br></br>

<input type="text" placeholder="Political Party" name="politicalparty" autofocus />
<br></br>

<input type="text" placeholder="University " name="university" autofocus />
<br></br>

<button type="submit">Search</button>
<br></br>


</form>
</p>

</body>
</html> 
