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
  Name: <input type = "text" name = "evt_name" >
  <span class="error">* </span><br><br>  
  Time: <input type = "time" name = "evt_time" >
   <span class="error">* </span><br><br>
  Date: <input type = "date" name = "evt_date" >
  <span class="error">* </span><br><br>
  Comment: <textarea name="evt_comment" rows="5" cols="40"></textarea>
  <br><br>
  Description: <input type = "text" name = "evt_description" >
   <br><br>
  Contact: <input type = "text" name = "evt_contact" >
  <br><br>
  <input type="submit" name="Submit" value="Submit">  
</form>
</body>
</html>
		
	