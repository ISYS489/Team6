<?php

//File Name: deactivateUser.php
//Purpose: Header for all pages
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 4/25/2014
	
require ('../mysqli_connect.php');
 error_reporting(E_ERROR | E_PARSE);
echo'

	<center>
	<img align="center" src="/img/civalScholarsLogo.png" alt="civility_image"></br>
	<h1>Civility In US Politics</h1></center>'



?>
<nav>
 
<?php
echo '
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="eventList.php">Event List</a></li>
<li><a href="search.php">Search Events</a></li>
<li><a href="pep.php">PEP Page</a></li>
<li><a href="about.php">About</a></li>';



 //Authorization check
 if (isset($_SESSION['userid']))

          {
		 
              $userId = $_SESSION['userid'];
				$userRoles = array();	
              $result = mysqli_query($dbc, "SELECT RoleId FROM `users-roles` WHERE UserId = $userId");
              while ($row = mysqli_fetch_array($result))
              {
                  $userRoles[] = $row[0];
          
		  };
		  
			
          }
		  
		  
  
 if  (in_array(4, $userRoles))
            {	
	

	echo '<li><a href="createEvent.php">Create Event</a></li>';
	echo '<li><a href="logout.php">Log Out</a></li>';
	echo '<li><a href="accountTools.php">Account Tools</a>
		<ul>           
			<li><a href="myPosts.php">my event posts</a></li>
			<li><a href="viewRatingReports.php">my ratings</a></li>
			<li><a href="classPosts.php">class posts</a></li>
		</ul>
		
		</li>';


            }
    
elseif  (in_array(3, $userRoles))
            {

	echo '<li><a href="createEvent.php">Create Event</a></li>';
		echo '<li><a href="logout.php">Log Out</a></li>';
	echo '<li><a href="accountTools.php">Account Tools</a>
		<ul>
			<li><a href="addKeywords.php">View/Add Keywords</a></li>
			<li><a href="createClass.php">Create Course </a></li>
			<li><a href="deactivateCourse.php">Deactivate Course </a></li>
			<li><a href="createUser.php">Create User</a></li>
			<li><a href="deactivateUser.php">Deactivate User</a></li>
			<li><a href="reports.php">View Reports</a></li>
		</ul>

		</li>';
          
			}
			
elseif (in_array(2, $userRoles))
            {

	echo '<li><a href="createEvent.php">Create Event</a></li>';
		echo '<li><a href="logout.php">Log Out</a></li>';
	echo '<li><a href="accountTools.php">Account Tools</a>
		<ul>
			<li><a href="addKeywords.php">View/Add Keywords</a></li>
			<li><a href="createClass.php">Create Course </a></li>
			<li><a href="deactivateCourse.php">Deactivate Course </a></li>
			<li><a href="createUser.php">Create User</a></li>
			<li><a href="deactivateUser.php">Deactivate User</a></li>
			<li><a href="reports.php">View Reports</a></li>
		</ul>

		</li>';
        
   
		}
            


 elseif (in_array(1, $userRoles))
       {
    

	echo '<li><a href="createEvent.php">Create Event</a></li>';
	echo '<li><a href="logout.php">Log Out</a></li>';
	echo '<li><a href="accountTools.php">Account Tools</a>
		<ul>
			<li><a href="addKeywords.php">View/Add Keywords</a></li>
			<li><a href="createClass.php">Create Course </a></li>
			<li><a href="deactivateCourse.php">Deactivate Course </a></li>
			<li><a href="createUser.php">Create User</a></li>
			<li><a href="deactivateUser.php">Deactivate User</a></li>
			<li><a href="reports.php">View Reports</a></li>
			<li><a href="createUniversity.php">Create University</a></li>
			<li><a href="deactivateUniversity.php">Deactivate University</a></li>
		</ul>

		</li>';

		

}

else{

echo '<li><a href="login.php">Login/Register</a></li>';
}



?>

</ul> 
</nav>
<br></br>
<br></br>

<link rel="stylesheet" type="text/css" href="/styles/mystyle.css">
