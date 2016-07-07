<?php

	include 'header.php';

	if (isSuperAdmin())
	{
		// Create University Button
		// unv_name = University's name
		// email = University's email
		// address = University's address
		// description = Description of University
		// population = Populatin of University
		
		echo "<form method = 'post' action = 'includes/createUnv.inc.php'>
			<input type = 'text' name = 'unv_name' placeholder='University Name'><br><br>
			<input type = 'text' name = 'email' placeholder='Email (ie. ucf.edu)'><br><br>
			<input type = 'text' name = 'address' placeholder='Address'><br><br>
			<input type = 'text' name = 'description' placeholder='Description'><br><br>
			<input type = 'population' name = 'population' placeholder='Population'><br><br>
			<input type = 'submit' name = 'Submit' value = 'Submit'>
			</form>";
	}
	else
	{
		// If not super admin, return to index
		header("Location: index.php");
	}