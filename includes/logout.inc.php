<?php

	// Destroys session information and heads to index
	session_start();
	session_destroy();
	header("Location: ../index.php");