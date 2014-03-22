<?php
session_start();
?>
//start the session

<html>


<head>
    <!--header -->

    <?php require 'header.php';
          require ('mysqli_connect.php');
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
            
            $queryString = "UPDATE `universities` SET `inactive`=true WHERE `UniversityId`='$universityId';";
            
            $command = @mysqli_query($dbc, $queryString); //run query
            
            if ($command) {//if it ran ok
            
            $universityDeactivated = @mysqli_query($dbc, "Select Name FROM universities WHERE UniversityId = $universityId")

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

            $result = mysqli_query($dbc,'SELECT UniversityId, Name FROM universities WHERE inactive <> 1 OR inactive IS NULL');

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
