<?php # login functions
//File Name: loginFunctions.php
//Purpose: Contains functions needed for login.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 3/30/2014
//this page defines two funtions used by the login/logout process


//redirects user to index for any website.
//for this particular website the passed argument is the index.
function redirect_user ($page = 'index.php'){
	//define URL
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	//remove any trailing slashes
	$url = rtrim($url, '/\\');
	
	// Add the page:
	$url .= '/' . $page;
	
	// Redirect User:
	header("location: $url");
	exit(); // Stops the script
	
}

//checks for valid login and returns true/false, and mySQL row containing username and first name or errors
function check_login($dbc, $username = '', $password = ''){
	
	$errors = array(); //creates error array
	
	//validate email adress
	if (empty($username)) {
		$errors[] = 'You forgot to enter your email address.';
	}else{
		$u = mysqli_real_escape_string($dbc, trim($username));
	}
	
	//validate password
	if (empty($password)) {
		$errors[] = 'You forgot to enter your password.';
	}else{
		$p = mysqli_real_escape_string($dbc, trim($password));
	}
	
	if (empty($errors)) { // if there are no errors
		
		//retrieve userid and first name
		$q = "SELECT userid, firstname FROM users WHERE username='$u' AND password=('$p')";
		$r = @mysqli_query ($dbc, $q);
		// run query
		
		//check result
		if (mysqli_num_rows($r) == 1){
			
			//fetch record
			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
			
			//return true
			return array(true, $row);
			
		}else{
			$errors[] = 'The username and password entered do not match those on file.';
		}
		
		//return false and errors
		return array(false, $errors);
	}
}
