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
    <h1>Deactivate a University</h1>
    <form id="deactivateUniversityForm" method="post">
        Select University to Deactivate:
        <br />
        <select name="university">
            <?php
            
            $result = mysqli_query($dbc,'SELECT UniversityId, Name FROM universities WHERE inactive <> 1 OR inactive IS NULL');
            
            while ($row=mysqli_fetch_array($result))
            {
                echo '<option value=' . htmlspecialchars($row['UniversityId']) . '">'
                . htmlspecialchars($row['Name'])
                . '</option>';
            }
            ?>
        </select>
        <br />
        <button type="submit" onclick="window.confirm('Are you sure you want to delete this University?')">Delete University</button>
    </form>
</body>
</html>
