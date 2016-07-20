<?php

	include ("header.php");

	if(loggedIn())
	{
		echo "RSO Name: <br>
			<form method = 'post' action = 'includes/createRSO.inc.php'>
			<input type = 'test' name = 'rsoname' /><br><br>
			Enter the email addresses of four other users: <br>
			<form method = 'post' action = 'includes/createRSO.inc.php'>
			<input type = 'text' name = 'email1' /> <br> <br>
			<input type = 'text' name = 'email2' /> <br> <br>
			<input type = 'text' name = 'email3' /> <br> <br>
			<input type = 'text' name = 'email4' /> <br> <br>
			<input type = 'text' name = 'email5' /> <br> <br>
			<input type = 'submit' name = 'Create RSO' value = 'Create RSO' />
			</form>";
	}
	else
	{
		header("Location: index.php");
	}