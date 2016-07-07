<?php

	include("header.php");
	
	if (loggedIn())
	{
	
		echo 'RSOs at your university:<br><br>';
	
		include 'dbhandler.php';
	
		// Find rso events
		// TODO, make unv_id dynamic
		$sql = "SELECT * FROM rso WHERE unv_id = 1 LIMIT 1";
		$response = mysqli_query($link, $sql);
		
		// Find rso's that user is already a part of
		$sqlName = "SELECT * FROM in_rso WHERE uid='".$_SESSION['uid']."'";
		$res = mysqli_query($link, $sqlName);
	
		if($response)
		{
			echo '<table align="left"
				cellspacing="5" cellpadding="8">
				<tr><td align="left"><b>ISO</b></td>
				<td align="left"><b>Name</b></td>
				</tr>';
	
			// mysqli_fetch_array will return a row of data from the query
			// until no further data is available
			while($rso = mysqli_fetch_array($response))
			{
				// rso that user is already a part of
				$in_rso = mysqli_fetch_array($res);
				
				// Show user information
				
	
				if (mysqli_num_rows($rso) == 1)
				{
					// Show rso name
					echo "<tr><td align='left'>" .
							$rso['name'] . "</td><td align='left'>";
					
					// Loops through rows and displays user info
					echo "<td align='left'>";
					
					// If user is not already a member of the rso, show join button
					if ($in_rso['rso_id'] != $rso['rso_id'])
					{
						// Clickable portion of user info
						echo "<form method='get' action='joinRSO.inc.php'>
							<input type='submit' name='" .'Join'. "'value='".$row['rso']."'/>
							</form>";
					}
					else
					{
						// Leave RSO
						echo "<form method='get' action=''>
							<input type='submit' name='" .'Joined'. "'value='".$row['iso']."'/>
							</form>";
					}
					
								
					echo '</tr>';
				}
			}
	
			echo '</table>';
	
		} else {
	
			$_SESSION['error'] = 4;
			header("Location: index.php");
	
		}
	
	}
	else
	{
		// Go home
		header("Location: index.php");
	}