<?php
//File Name: viewRatings.php
//Purpose: This page displays ratings reports
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Gottfried
//Last Date Modified: 4/13/2014

//start the session
session_start();
?><html>



<head>
<!-- navigation bar -->
<?php
    include("header.php");
    require("../mysqli_connect.php");
    $userId = 0;
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

</head>
<body>
    <h1>Ratings</h1>
    <br/><br/>
    <center>
    <!--Select element that contains available courses to choose from-->
    <form id="courseSelectionForm" method="get" align='center'>
    <select name="ClassId">
        <!-- student&professor -->
        <?php
        if (in_array(4, $userRoles) OR in_array(3, $userRoles))
        {
            $query = "SELECT `classes`.ClassId, `classes`.ClassName
            FROM `classes`
            LEFT OUTER JOIN `users-classes` ON `classes`.ClassId = `users-classes`.ClassId
            WHERE `users-classes`.UserId = $userId AND `classes`.IsActive = true";
            $result = mysqli_query($dbc, $query);
                
            while($row = mysqli_fetch_array($result))
            {
                if ($_GET['ClassId'] != $row['ClassId'])
                {
                    
                    echo '<option value=' . htmlspecialchars($row['ClassId']) . '>'
                    . htmlspecialchars($row['ClassName'])
                    . '</option>';
                }
                else
                {
                    echo '<option value=' . htmlspecialchars($row['ClassId']) . ' selected=selected>'
                    . htmlspecialchars($row['ClassName'])
                    . '</option>';
                }
            }
        }
        ?>
        
        <!-- university admin -->
        <?php
        if (in_array(2, $userRoles))
        {
            //Find UniversityId of current user
            
            $query = "SELECT UniversityId
            FROM Users
            WHERE UserId = $userId";
            $result = mysqli_query($dbc, $query);
            
            $universityId;
            while ($row = mysqli_fetch_row($result)) {
                    $universityId = $row[0];
                }
            
            //Now grab call classes that belong to selected university
            
            $query = "SELECT ClassId, ClassName
            FROM classes
            WHERE UniversityId = $universityId AND IsActive = true";
            $result = mysqli_query($dbc, $query);
            
            while($row = mysqli_fetch_array($result))
            {
                if ($_GET['ClassId'] != $row['ClassId'])
                {
                    echo '<option value=' . htmlspecialchars($row['ClassId']) . '>'
                    . htmlspecialchars($row['ClassName'])
                    . '</option>';
                }
                else
                {
                    echo '<option value=' . htmlspecialchars($row['ClassId']) . ' selected=selected>'
                    . htmlspecialchars($row['ClassName'])
                    . '</option>';
                }
            }
        }
        ?>
        
        <!-- site admin -->
        <?php
        if (in_array(1, $userRoles))
        {
            $query = "Select ClassId, ClassName
            FROM classes
            WHERE IsActive = true";
            $result = mysqli_query($dbc, $query);
            
            while($row = mysqli_fetch_array($result))
            {
                if ($_GET['ClassId'] != $row['ClassId'])
                {
                    echo '<option value=' . htmlspecialchars($row['ClassId']) . '>'
                    . htmlspecialchars($row['ClassName'])
                    . '</option>';
                }
                else
                {
                    echo '<option value=' . htmlspecialchars($row['ClassId']) . ' selected=selected>'
                    . htmlspecialchars($row['ClassName'])
                    . '</option>';
                }
            }
        }
        ?>        
    </select>
    
    	<button type="submit">Grab Ratings for this Course</button>
    </center>
    </form>
    
    <table align='center' bgcolor='282164'>
        <tr bgcolor='9B1321'>
        	<th>Rater Name</th>
            <th>Event Name</th>
            <th>Comment</th>
            <th>Rating</th>
            <th>Date</th>
            <?php /* If the user is a Proffesor, University Administrator or Site Admin delete row needs to exist. */
            if (in_array(1, $userRoles) OR in_array(2, $userRoles) OR in_array(3, $userRoles))
            {
                //echo '<th>Delete Rating</th>';
            }
            ?>
        </tr>
            <!-- student -->
            <?php
            if ($_GET['ClassId'])
            {
                $classId = $_GET['ClassId'];
                if (in_array(4, $userRoles))
                {
                    $query = "SELECT u.FirstName, u.MiddleInitial, u.LastName, e.EventName, e.EventId, r.Comment, r.Rating, r.RatingDate
                    FROM `ratings` AS r
                    LEFT OUTER JOIN `events` AS e ON r.EventId = e.EventId
                    LEFT OUTER JOIN `users-classes` AS uC ON r.UserId = uC.UserId
                    LEFT OUTER JOIN `users` AS u On uC.UserId = u.UserId
                    WHERE r.UserId = $userId AND uC.ClassId = $classId";
                    $result = mysqli_query($dbc, $query);
                
                    while($row = mysqli_fetch_array($result))
                    {
                          echo "<tr>";
                          echo "<td>" . $row['FirstName'] ." ". $row['MiddleInitial'] ." ". $row['LastName'] ."</td>";
                          echo "<td>" . "<a href=\"viewEvent.php?eid=".$row['EventId']."\" id='eventlist' >" . $row['EventName'] . "</a></td>";
                          echo "<td>" . $row['Comment'] . "</td>";
                          echo "<td>" . $row['Rating'] . "</td>";
                          echo "<td>" . $row['RatingDate'] . "</td>";
                      
                          echo "</tr>";
                    }
                }
                else
                {
                    $query = "SELECT u.FirstName, u.MiddleInitial, u.LastName, e.EventName, e.EventId, r.Comment, r.Rating, r.RatingDate
                    FROM `ratings` AS r
                    LEFT OUTER JOIN `events` AS e ON r.EventId = e.EventId
                    LEFT OUTER JOIN `users-classes` AS uC ON r.UserId = uC.UserId
                    LEFT OUTER JOIN `users` AS u On uC.UserId = u.UserId
                    WHERE uC.ClassId = $classId";
                    $result = mysqli_query($dbc, $query);
                
                    while($row = mysqli_fetch_array($result))
                    {
                          echo "<tr>";
                      	  echo "<td>" . $row['FirstName'] ." ". $row['MiddleInitial'] ." ". $row['LastName'] ."</td>";
                          echo "<td>" . "<a href=\"viewEvent.php?eid=".$row['EventId']."\" id='eventlist' >" . $row['EventName'] . "</a></td>";
                          echo "<td>" . $row['Comment'] . "</td>";
                          echo "<td>" . $row['Rating'] . "</td>";
                          echo "<td>" . $row['RatingDate'] . "</td>";
                      
                          echo "</tr>";
                    }
                }
            }
            
            ?>
            
            
            </table>
            
</body>
