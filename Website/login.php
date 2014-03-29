<?php # login_session.php
//processes login from submission using sessions

//check if form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//Need two helper files
	require ('login_functions.php');
	require ('mysqliConnect.php');
	
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