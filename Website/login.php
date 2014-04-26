<?php # login_session.php
//File Name: login.php
//Purpose: This page uses loginFunctions.php and loginPage.php to log in a user.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 3/30/2014
//processes login from submission using sessions

//check if form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//Need two helper files
	require ('loginFunctions.php');
	require ('../mysqli_connect.php');
	
	//check login
	list ($check, $data) = check_login($dbc, $_POST['username'], $_POST['password']);
	
	if ($check) {
		
		//set session data:
		session_start();
		$_SESSION['userid'] = $data['userid'];
		$_SESSION['password'] = $data['password'];
		
		//Redirect:
		redirect_user('accountTools.php');
		
	}else{
		
		//assign $data to $errors for loginPage.php:
		$errors = $data;
		
	}
	
	mysqli_close($dbc);
	
}

include ('loginPage.php');

?>
