<?php


session_start();
?>


<html>

<head>

    <!--header -->
<?php 	
require 'header.php';
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

        if (!is_null($_POST['ClassId']))
        {
            $ClassId = $_POST['ClassId'];

            
			//Set Class to InActive
            $command = @mysqli_query($dbc, "UPDATE `classes` SET `IsActive`=false WHERE `ClassId`='$ClassId';"); //run query
            if ($command) {//if it ran ok
				
				//Migrate all users in course to new course
				$command = @mysqli_query($dbc, "UPDATE `users-classes` SET `ClassId`=10001 WHERE `ClassId`='$ClassId';");
				
				if ($command)
				{//if it ran ok
					$courseDeactivated;
					$result = @mysqli_query($dbc, "SELECT ClassName FROM classes WHERE ClassId = '$ClassId'");
					while ($row = mysqli_fetch_row($result)) {
						$courseDeactivated = $row[0];
					}
				}
				


                //print message:
                echo "<h1>Thank You!</h1>
			<p>You have deactivated $courseDeactivated.</p>";

            }else{ //if not ok

                echo '<h1>Error</h1>
			<p>System error preventing Course deactivation.</p>';
            }
        }
    }

    ?>


    <h1>Deactivate a Course</h1>
    <form id="deactivateCourseForm" method="post">
        Select Course to Deactivate:
        <br />
        <select name="ClassId">
            <?php

            $result = mysqli_query($dbc,'SELECT ClassId, ClassName FROM classes WHERE isActive = true AND ClassId <> 10001');

            while ($row=mysqli_fetch_array($result))
            {
                echo '<option value=' . htmlspecialchars($row['ClassId']) . '>'
                . htmlspecialchars($row['ClassName'])
                . '</option>';
            }

            mysqli_close($dbc);
            ?>
        </select>
        <br />
        <button type="submit" onclick="window.confirm('Are you sure you want to deactivate this Course?')">Deactivate Course</button>
    </form>
</body>
</html>
		 
          
          
