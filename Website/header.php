<?php 

echo'
<ul class ="nav">
<li><a href="index.php">Home</a></li>
<li><a href="eventlist.php">Event List</a></li>
<li><a href="search.php">Search Events</a></li>
<li><a href="http://www.ferris.edu/pep/" target="_blank">PEP Page</a></li>
<li><a href="about.php">About</a></li>';


if (isset($_SESSION['userid'])){
	echo '<li><a href="accounttools.php">Account Tools</a></li>';
	echo '<li><a href="logout.php">Log Out</a></li>';

}else{
	echo '<li><a href="login.php">Login/Register</a></li>';
}



?>

</ul> 
<link rel="stylesheet" type="text/css" href="mystyle.css">