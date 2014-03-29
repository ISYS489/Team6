<?php # mysqli_connect.php

// DB access info
// established connection to DB
// selects DB, sets encoding

//Set the database acess info as constants:
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'isys489c_brteam6');

//Make Connection   @= hide errors                                    die will terminate function of the script
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());

// Set the encoding...
mysqli_set_charset($dbc, 'uft8');