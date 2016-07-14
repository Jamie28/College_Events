<?php

	include 'header.php';
	
	if (loggedIn())
	{
		if (isSuperAdmin())
		{
			// Create University Button
			echo "<form method='get' action='createUnv.php'>
				<button type='submit'>Create University</button>
				</form>";
			// Approve Events
			echo "<form method='get' action='approveEvent.php'>
				<button type='submit'>Approve Events</button>
				</form>";
		}
		else if (isAdmin())
		{
			// Create Event
			echo "<form method='get' action='createEvent.php'>
				<button type='submit'>Create Event</button>
				</form>";
			// Join rso
			echo "<form method='get' action='joinRSO.php'>
				<button type='submit'>Join RSO</button>
				</form>";
			// Create rso
			echo "<form method='get' action='createRSO.php'>
				<button type='submit'>Create RSO</button>
				</form>";
			// View events
			echo "<form method='get' action='viewEvents.php'>
				<button type='submit'>View Events</button>
				</form>";
		}
		else // If student
		{
			// Join rso
			echo "<form method='get' action='joinRSO.php'>
				<button type='submit'>Join RSO</button>
				</form>";
			echo "<form method='get' action='include\events.inc.php'>
				<button type='submit'>Event Info</button>
				</form>";
			// Create rso
			echo "<form method='get' action='createRSO.php'>
				<button type='submit'>Create RSO</button>
				</form>";
			// View events
			echo "<form method='get' action='viewEvents.php'>
				<button type='submit'>View Events</button>
				</form>";
		}
	}
	
	?>
	
	