<?php
/*
File Name: createUniversity.php
Purpose: Checks whether or not a user is authorized to access a page.
Class: ISYS489
Instructor: Amy Buse
Author: Kyle Gottfried
Last Date Modified: 3/28/2014 
*/
require('../mysqli_connect.php');

function IsUserAuthorized($userId, $authorizedUserRoles) //int, int Array
{
    global $dbc;
	$userRoles = array();
    $result = mysqli_query($dbc, "SELECT RoleId FROM `users-roles` WHERE UserId = $userId"); //Get all Roles for user
    while ($row = mysqli_fetch_array($result))
    {
        $userRoles[] = $row[0];
    }
    
      if (!in_array($authorizedUserRoles, $userRoles)) //If user's roles are not present in $authorizedUserRoles return false. //Is always false as instead of checking each value in $authorizedUserRoles against the haystack it uses the $authorizedUserRoles array itself as the needle.
      {return false;}
      else
      {return true;}
}

?>