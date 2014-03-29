<?php //logs out user by clearing session variable

//starts session
session_start();

$_SESSION = array(); //clears out session variables.
session_destroy(); //Destroys session itself.
setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); //destroy the cookie.

require ('loginFunctions.php');
redirect_user();                //sends user to homepage.

?>