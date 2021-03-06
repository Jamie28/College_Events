<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {
color: #FF0000;}
#map {
width: 40%;
height: 400px;}
#lat, #lng {
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
<p><span class="error">* Required</span></p>
<form method = "post" action = 'includes/createEvent.inc.php'>				
  Event Name: <input type = "text" name = "evt_name" value="" >
  <span class="error">* </span><br><br>  
  Time: <input type = "time" name = "evt_time" value="" >
  <span class="error">* </span><br><br>
  Date: <input type = "date" name = "evt_date" value="" >
  <span class="error">* </span><br><br>
  Type: <select name="event_type" id="event_type">
  <option value="public">Public</option>
  <option value="private">Private</option>
  
  <?php  
  //add all RSOs that belong to the user, to the "event-type" drop down list
  include "dbhandler.php";
  
  $sql = "SELECT r.rso_name
		  FROM rso r
		  WHERE r.owner_id = '".$_SESSION['uid']."' ";
  $result = mysqli_query($link, $sql);
  
  while($row = mysqli_fetch_array($result))
  {
  	$rsoname = $row['rso_name'];
  	echo "<option value=\"$rsoname\"> $rsoname </option>";
  }
  ?>
  
  </select><br><br>
  Comments: <br><br> <textarea name="evt_comment" rows="5" cols="40"></textarea><br><br> 
  Description: <input type = "text" name = "evt_description" value=""><br><br>    
  Contact Phone (e.g. 888-888-8888): <input type = "text" name = "evt_contact" value="" >
  <span class="error">* </span><br><br> 
  Location: <input type = "text" name = "lat" id="lat" value="28.601492">
  <input type = "text" name = "lng" id="lng" value="-81.200140">
  <span class="error">* </span><br><br>
  Address: <input type = "text" name = "address" id="address" value="UCF"><br><br> 
  <div id="map"></div>
  <div id="capture"></div>
 
  <script>
	var map;
	var defLatLng = {lat: 28.601492, lng: -81.200140};
	var marker;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 28.601492, lng: -81.200140},
			zoom: 15
		});
	marker = new google.maps.Marker({
		position: defLatLng,
		map: map
		});
	var geocoder = new google.maps.Geocoder;
	google.maps.event.addListener(map, 'click', function(event) {
		addMarker(geocoder, event.latLng, map);
	});
	}

	function addMarker(geocoder, location, map){
		marker.setPosition(location);
		document.getElementById("lat").value = location.lat();
		document.getElementById("lng").value = location.lng();
		var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + location.lat() + "," + location.lng();
		var xhReq = new XMLHttpRequest();
		xhReq.open("GET", url, false);
		xhReq.send(null);
		var jsonObject = JSON.parse(xhReq.responseText);
		document.getElementById("address").value = jsonObject.results[1].formatted_address;
	}
  </script>
  
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ_F7TCpsW-MDsigvIsqdVeoE6hOfa__0&callback=initMap">
  </script>
  
  <br><input type="submit" name="Submit" value="Submit">  
</form>
</body>
</html>