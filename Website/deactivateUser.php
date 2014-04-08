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

        if (!is_null($_POST['UserId']))
        {
            $UserIds = $_POST['UserId'];

            

            $command = @mysqli_query($dbc, "UPDATE `users` SET `IsActive`=false WHERE `UserId`='$UserIds';"); //run query




            



            if ($command) {//if it ran ok
                $userDeactivated;
                $result = @mysqli_query($dbc, "SELECT Username FROM users WHERE UserId = '$UserIds'");
                while ($row = mysqli_fetch_row($result)) {
                    $userDeactivated = $row[0];
                }
				


                //print message:
                echo "<h1>Thank You!</h1>
			<p>You have deactivated $userDeactivated.</p>";

            }else{ //if not ok

                echo '<h1>Error</h1>
			<p>System error preventing User deactivation.</p>';
            }
        }
    }

    ?>


    <h1>Deactivate a User</h1>
    <form id="deactivateUserForm" method="post">
        Select User to Deactivate:
        <br />
        <select name="UserId">
            <?php

            $result = mysqli_query($dbc,'SELECT UserId, Username FROM users WHERE isActive = true');

            while ($row=mysqli_fetch_array($result))
            {
                echo '<option value=' . htmlspecialchars($row['UserId']) . '>'
                . htmlspecialchars($row['Username'])
                . '</option>';
            }

            mysqli_close($dbc);
            ?>
        </select>
        <br />
        <button type="submit" onclick="window.confirm('Are you sure you want to deactivate this User?')">Deactivate User</button>
    </form>
</body>
</html>
		 
          
          
