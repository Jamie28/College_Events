<?php

	include 'header.php';
	
	// Displays sign up form
	// Username -> username
	// Password -> password
	// Re-enter Password -> password_check
	// First Name -> first_name
	// Last Name -> last_name
	// Email -> email
	
	// If you are not already logged in you can create an account
	if(!loggedIn())
	{
		echo "<form method = 'post' action = 'includes/signup.inc.php'>
				<input type = 'text' name = 'username' placeholder='Username' /><br><br>
				<input type = 'password' name = 'password' placeholder='Password' /><br><br>
				<input type = 'password' name = 'password_check' placeholder='Re-Enter Password'/><br><br>
				<input type = 'text' name = 'email' placeholder='Email'/><br><br>
				<input type = 'submit' name = 'Create Account' value = 'Create Account' />";
	}
	else
	{
		header("Location: index.php");
	}