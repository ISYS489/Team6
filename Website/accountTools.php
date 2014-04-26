<?php
//File Name: accountTools.php
//Purpose: Displays user options based on user-role DB table.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 3/30/2014

//start the session
session_start();
?>




<html>


<head>
    <!--header-->

    <?php require 'header.php';
          require ('mysqliConnect.php');
          //Authorization check
          if ($_SESSION['userid'])
          {
              $userId = $_SESSION['userid'];
              $userRoles = array();
              $result = mysqli_query($dbc, "SELECT RoleId FROM `users-roles` WHERE UserId = $userId");
              while ($row = mysqli_fetch_array($result))
              {
                  $userRoles[] = $row[0];
              };
          }
          else
          {
              header("location: index.php");
          }
    ?>


    <h1>Account Tools</h1>
</head>

<body>

    <p>
        <h1>Welcome to Your Account Tools</h1>



        <ul class="accounttools">
            <!-- student -->
            <?php
            if (in_array(4, $userRoles))
            {
                echo '<ul class ="Student">
<li><a href="myPosts.php">my event posts</a></li>
<li><a href="viewRatingReports.php">my ratings</a></li>
<li><a href="classPosts.php">class posts</a></li>
</ul>';
            }
            ?>

            <!-- professor-->
            <?php
            if (in_array(3, $userRoles))
            {
                echo '<ul class ="Professor">
<li><a href="addKeywords.php">View/Add Keywords</a></li>
<li><a href="createClass.php">Create Course </a></li>
<li><a href="deactivateCourse.php">Deactivate Course </a></li>
<li><a href="createUser.php">Create User</a></li>
<li><a href="deactivateUser.php">Deactivate User</a></li>
<li><a href="reports.php">View Reports</a></li>
</ul>';
            }
            ?>


            <!-- university admin-->
            <?php
            if (in_array(2, $userRoles))
            {
                echo '<ul class ="UniversityAdmin">
<li><a href="addKeywords.php">View/Add Keywords</a></li>
<li><a href="createClass.php">Create Course </a></li>
<li><a href="deactivateCourse.php">Deactivate Course </a></li>
<li><a href="createUser.php">Create User</a></li>
<li><a href="deactivateUser.php">Deactivate User</a></li>
<li><a href="reports.php">View Reports</a></li>
</ul>';
            }
            ?>

            <!-- site admin -->
            <?php
            if (in_array(1, $userRoles))
            {
                echo '<ul class ="SiteAdmin">
<li><a href="addKeywords.php">View/Add Keywords</a></li>
<li><a href="createClass.php">Create Course </a></li>
<li><a href="deactivateCourse.php">Deactivate Course </a></li>
<li><a href="createUser.php">Create User</a></li>
<li><a href="deactivateUser.php">Deactivate User</a></li>
<li><a href="reports.php">View Reports</a></li>
<li><a href="createUniversity.php">Create University</a></li>
<li><a href="deactivateUniversity.php">Deactivate University</a></li>
</ul>
</ul>';
            }
            ?>


        </ul>
		
		        <!--link to account settings page-->
        <ul class="accountSettings">
            <li>
                <a href="accountSettings.php">Account Settings</a>
            </li>
        </ul>
    </p>

</body>
</html>
