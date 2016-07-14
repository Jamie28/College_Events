<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
#map {
width: 40%;
height: 400px;}
#latlng {
width: 75px;}
html, body {
height: 100%;
margin: 0;
padding: 0;
}
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
  Location: <input type = "text" name = "lat" id="latlng" value="28.601492">
  <input type = "text" name = "lng" id="latlng" value="-81.200140">
  <span class="error">* </span><br><br> 
  <div id="map"></div>
  <div id="capture"></div>
  <script>
	var map;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 28.601492, lng: -81.200140},
			zoom: 15
		});
	}
  </script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ_F7TCpsW-MDsigvIsqdVeoE6hOfa__0&callback=initMap">
    </script>
    <br>
  <input type="submit" name="Submit" value="Submit">  
</form>
</body>
</html>
		
	