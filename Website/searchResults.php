<?php
session_start();
?>
//start the session

<html>


<head>
<!--header-->

<?php require 'header.php'; ?>

<h1>Search Results</h1>
</head>

<body>


<form class ="searchresults" id="searchresults" method="post" action="search.php">
<button type="submit" >Search Again</button>
</form>


<h2></h2>
<p>


<table>

<tr>
	<td>Post #</td>
	<td>Post Name</td>
	<td>Rating </td>
	<td>Time/Date</td>
	<td>Media Type</td>
	<td>Course #</td>
	<td>Political Party</td>
	<td>University </td>
	<td>Person of Interest</td>
</tr>
</table>



<form class ="searchresults" id="searchresults" method="post" action="search.php">
<button type="submit" >Search Again</button>
</form>


</p>


</body>
</html> 
