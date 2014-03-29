<!--
File Name: createUniversity.php
Purpose: Deactivate a University
Class: ISYS489
Instructor: Amy Buse
Author: Kyle Gottfried
Last Date Modified: 3/28/2014
-->
<?php
session_start();
?>
//start the session

<html>


<head>
    <!--header -->

    <?php require 'header.php';
          require ('mysqliConnect.php');
          if ($_SESSION['userid'])
          {
              $userId = $_SESSION['userid'];
              $userRoles = array();
              $result = mysqli_query($dbc, "SELECT RoleId FROM `users-roles` WHERE UserId = $userId");
              while ($row = mysqli_fetch_array($result))
              {
                  $userRoles[] = $row[0];
              }
              if (!in_array(1, $userRoles))
                  header("location: index.php");
          }
          else
          {
          	header("location: index.php");
          }
          
          
    ?>


</head>

<body>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $errors = array(); //Initialize an error array.

        if (!is_null($_POST['universityId']))
        {
            $universityId = $_POST['universityId'];

            $queryString = "UPDATE `universities` SET `IsActive`=false WHERE `UniversityId`='$universityId';"; //Set University to Inactive

            $command = @mysqli_query($dbc, $queryString); //run query

            $queryString = "UPDATE `classes` SET `IsActive`=false WHERE `UniversityId` = '$universityId';"; //Set classes that belong to University to Inactive

            $command = @mysqli_query($dbc, $queryString); //run query

            $queryString = "UPDATE `users-classes` SET `ClassId`=10001 WHERE `ClassId` = "; //Build inital base for Setting all users new classes as the "Default Public Class"

            $result = @mysqli_query($dbc, "SELECT ClassId FROM classes WHERE UniversityId = '$universityId'"); //Fetch all classes that belong to the University being deactivated.
            $rowCount = count($result);
            $intRowTracker = 0;

            while ($row = mysqli_fetch_array($result)) // Builds Where clause for SQL UPDATE Statement
            {
                if ($intRowTracker == 0){
                    $queryString = $queryString . "$row[0]";
                    $intRowTracker++;
                }
                else
                {
                	$queryString = $queryString . " OR `ClassId` = $row[0]";
                }
            }

            var_dump($queryString);

            $command = @mysqli_query($dbc, $queryString); //run query

            if ($command) {//if it ran ok
                $universityDeactivated;
                $result = @mysqli_query($dbc, "SELECT Name FROM universities WHERE UniversityId = '$universityId'");
                while ($row = mysqli_fetch_row($result)) {
                    $universityDeactivated = $row[0];
                }


                //print message:
                echo "<h1>Thank You!</h1>
			<p>You have deactivated $universityDeactivated.</p>";

            }else{ //if not ok

                echo '<h1>Error</h1>
			<p>System error preventing University deactivation.</p>';
            }
        }
    }

    ?>


    <h1>Deactivate a University</h1>
    <form id="deactivateUniversityForm" method="post">
        Select University to Deactivate:
        <br />
        <select name="universityId">
            <?php

            $result = mysqli_query($dbc,'SELECT UniversityId, Name FROM universities WHERE isActive = true');

            while ($row=mysqli_fetch_array($result))
            {
                echo '<option value=' . htmlspecialchars($row['UniversityId']) . '>'
                . htmlspecialchars($row['Name'])
                . '</option>';
            }

            mysqli_close($dbc);
            ?>
        </select>
        <br />
        <button type="submit" onclick="window.confirm('Are you sure you want to deactivate this University?')">Deactivate University</button>
    </form>
</body>
</html>
