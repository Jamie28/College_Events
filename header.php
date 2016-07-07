<?php

	// Always start a new page with a session
	// Allows user information to be tracked across website
	// And include our functions
	session_start();
	include 'includes/functions.inc.php';
?>

<link rel='stylesheet' type='text/css' href='style.css'>
<header>
<nav>
<ul>

<?php 
	// Home button
	echo "<li><a href='index.php'>HOME</a></li>";

	// Check if logged in
	if (loggedIn())
	{
		// Show username and login button in header
		if (isset($_SESSION['username']))
			echo $_SESSION['username'];
		if (isset($_SESSION['status']))
		{
			if($_SESSION['status'] == 1)
				echo ' [Administrator]';
			else if ($_SESSION['status'] == 2)
				echo ' [Super Administrator]';
		}
		
		echo "<form method='get' action='includes/logout.inc.php'>
				<button type='submit'>Logout</button>
				</form>";
	}
	// If not logged in
	else
	{
		// Show login form in the header
		echo "<form method = 'post' action = 'includes/login.inc.php'>
			<input type = 'text' name = 'username' placeholder='Username'>
			<input type = 'password' name = 'password' placeholder='Password'>
			<input type = 'submit' name = 'Log In' value = 'Log In'>
			</form>";
			
		// Sign up link
		echo "<form method = 'post' action = 'signup.php'>
			<input type='submit' name = 'Sign Up' value = 'Sign Up'></form>";
	}		
?>

</ul>
</nav>
</header>

<?php 

	// Checks for error before every page
	if (error())
	{
		errorMsg();
	}
?>