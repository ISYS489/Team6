<html>
<!-- included for testing purposes -->

<ul class ="nav">
<li><a href="index.php">Home</a></li>
<li><a href="eventlist.php">Event List</a></li>
<li><a href="search.php">Search Events</a></li>
<li><a href="http://www.ferris.edu/pep/">PEP Page</a></li>
<li><a href="login.php">Login/Register</a></li>
<li><a href="about.php">About</a></li>
<li><a href="accounttools.php">Account Tools</a></li>
</ul>

<!-- link to style sheet -->
<link rel="stylesheet" type="text/css" href="mystyle.css">

<head>
<!--header-->
<?php require 'header.php'; ?>
<h1>Edit Account</h1>
</head>

<body>

<p>
<h1>Edit Your Account Information</h1>
<!-- needs to be changed -->
<form class ="search" id="search" method="post" action="index.php">


<input type="text" placeholder="Course # " name="coursenumber" autofocus />
<br></br>

<input type="text" placeholder="University " name="university" autofocus />
<br></br>

<input type="text" placeholder="First Name" name="firstname" autofocus />
<br></br>

<input type="text" placeholder="Middle Initial" name="middleinitial" autofocus />
<br></br>

<input type="text" placeholder="Last Name" name="lastname" autofocus />
<br></br>


<button type="submit">Submit Changes</button>
<br></br>

</p>

</body>
</html> 
