<?php # login_session.php
//processes login from submission using sessions

//check if form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//Need two helper files
	require ('login_functions.php');
	require ('mysqli_connect.php');
	
	//check login
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['password']);
	
	if ($check) {
		
		//set session data:
		session_start();
		$_session['userid'] = $data['userid'];
		$_session['password'] = $data['password'];
		
		//Redirect:
		redirect_user(index.php);
		
	}else{
		
		//assign $data to $errors for login.php:
		$errors = $data;
		
	}
	
	mysqli_close($dbc);
	
}

include ('login.php');

?>