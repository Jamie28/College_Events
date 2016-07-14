<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
	
<?php include 'header.php';?>
<h2>Create A New Event</h2>
<p><span class="error">* required field</span></p>
<form method = "post" action = 'includes/createEvent.inc.php'>				
  Event Name: <input type = "text" name = "evt_name" value="" >
  <span class="error">* </span><br><br>  
  Time: <input type = "time" name = "evt_time" value="" >
   <span class="error">* </span><br><br>
  Date: <input type = "date" name = "evt_date" value="" >
  <span class="error">* </span><br><br>
  Comments: <textarea name="evt_comment" rows="5" cols="40"></textarea>
  <br><br>
  Description: <input type = "text" name = "evt_description" value="">
   <br><br>  
  Contact Phone (e.g. 4073328888): <input type = "text" name = "evt_contact" value="" >
  <span class="error">* </span><br><br> 
  Location: <input type = "text" name = "location" value="">
  <span class="error">* </span><br><br> 
  <input type="submit" name="Submit" value="Submit">  
</form>
</body>
</html>
		
	