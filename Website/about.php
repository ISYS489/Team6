<?php
//File Name: about.php
//Purpose: This page displays information about the website.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 4/8/2014

//start the session
session_start();
?>

<html>



<head>
<!-- navigation bar -->
<?php include("header.php");?>

</head>


<body>




<br>
<h1>About Us</h1>

<p>
<table align="center">
			<tr>
				<td>
					<!--image-->
					<div id="f1_container">
                    <div id="f1_card" class="shadow">
                    <div class="front face">
					<img src="/img/civ2.gif" alt="civility2_image">
					  </div>
                       <div class="back face center">
						<p class="move" style="width:85px" >Civility is our passion .</p>  
						<p class="move" style="width:85px">Enjoy the site!!!!.</p>
					  </div>
					</div>
					</div>
				</td>
				<td>
					This site debates civility issues and provides ratings on various events in history. <br>
					<br>
					Unregistered guests are welcome to browse all the content. <br>
					<br>
					Users that would like to post,comment, and rate events must register.<br>
					<br>
					Thank you for taking the time to visit our site. <br>
					<br>
					If you have any questions, please contact the site administrator at admin@brteam6.com
				</td>
			</tr>
		</table>
	
</p>

</body>
</html> 
