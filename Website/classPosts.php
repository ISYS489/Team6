<?php
//File Name: classPosts.php
//Purpose: Page lists events.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Thompson
//Last Date Modified: 3/28/2014


//start the session & set logged in user's ID
session_start();
$userID = $_SESSION['userId'];
?>


<html>

<head>

    <?php include("header.php");?>

</head>
<body>

    <h1>Class Posts</h1>

    <div style="text-align:center;">
        <table style="margin-left:auto; margin-right:auto;">
            <tr>
                <th>
                    Event Name
                </th>
                <th>
                    News Outlet
                </th>
                <th>
                    Media Type
                </th>
                <th>
                    Important Figure Name
                </th>
                <th>
                    Political Party
                </th>
                <th>
                    Date of Event
                </th>
                <th>
                    Date of Upload:
                </th>
            </tr>
            <tr>
                <td>
                    Gettysburg Address
                </td>
                <td>
                    Cleveland Morning Leader
                </td>
                <td>
                    Newpaper
                </td>
                <td>
                    Abraham Lincoln
                </td>
                <td>
                    Republican Party
                </td>
                <td>
                    November 19, 1863
                </td>
                <td>
                    November 23, 1863
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
