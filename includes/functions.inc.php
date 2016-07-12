<?php
	// Error variable $_SESSION
	
	// Returns true if user is logged in, false otherwise
	function loggedIn()
	{
		if (isset($_SESSION['logged_in']))
			return true;
			else
				return false;
	}
	
	function isAdmin()
	{
		if (isset($_SESSION['status']) && $_SESSION['status'] == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function isSuperAdmin()
	{
		if (isset($_SESSION['status']) && $_SESSION['status'] == 2)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	// Checks for error returns by scripts
	function error()
	{
		if (isset($_SESSION['error']) && $_SESSION['error'] > 0)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	// Displays error then erases error
	function errorMsg()
	{
		// error codes:
		// 9 - General error (for testing)
		// 8 - Could not create event
		// 7 - Email not in database
		// 6 - Could not create user
		// 5 - Passwords don't match
		// 4 - Data Missing
		// 3 - Could not create university
		// 2 - Success (Not an actual error)
		// 1 - invalid login
		// 0 - no error
		if (isset($_SESSION['error']) && $_SESSION['error'] > 0)
		{
			if ($_SESSION['error'] == 1)
			{
				echo "Invalid Login<br>";
			}
			else if ($_SESSION['error'] == 2)
			{
				echo "Success<br>";
			}
			else if ($_SESSION['error'] == 3)
			{
				echo "Could not create university.<br>";
			}
			else if ($_SESSION['error'] == 4)
			{
				echo 'You need to enter the following data<br />';
			
				foreach($_SESSION['data_missing'] as $missing)
				{
					echo "$missing<br />";
				}
			}
			else if ($_SESSION['error'] == 5)
			{
				echo "Passwords don't match.<br>";
			}
			else if ($_SESSION['error'] == 6)
			{
				echo "Could not create user.<br>";
			}
			else if ($_SESSION['error'] == 7)
			{
				echo "Email is not in database.<br>";
			}
			else if ($_SESSION['error'] == 8)
			{
				echo "Could not create event.<br>";
			}
			else if ($_SESSION['error'] == 9)
			{
				echo "Error<br>";
			}
			// reset error
			$_SESSION['error'] = 0;
		}
	}