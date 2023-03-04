<!DOCTYPE html>
<html>
<head>
	<title>Geocoding Service</title>
	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"> 	</script>
	<link rel="stylesheet" type="text/css" href="./style.css" />
	<!--<script src="./index.js"></script>-->
	<style>
		/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
		#map {
			height: 100%;
		}

		/* Optional: Makes the sample page fill the window. */
		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
		}

		#floating-panel {
			position: absolute;
			top: 10px;
			left: 25%;
			z-index: 5;
			background-color: #fff;
			padding: 5px;
			border: 1px solid #999;
			text-align: center;
			font-family: "Roboto", "sans-serif";
			line-height: 30px;
			padding-left: 10px;
		}
	</style>
</head>
<body>
<?php
if(isset($location)){

}

?>
<?php  if (isset($_SESSION['user'])){
	if (time()-$_SESSION["login_time"]>10040){
		unset($_SESSION['user']);
		echo header("Location: logout");
		die();

	}
	else{
		$_SESSION["login_time"]=time();
	}
}
?>
<?php

//<!--JS refresh -->
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");
echo ("{");
echo ("window.location.reload();");
echo ("}");
echo ("setTimeout('fresh_page()',10042000);");
echo ("</script>");?>

<div id="floating-panel">
	<input id="address" type="textbox" value="<?php echo $location?>"/>
	<input id="submit" type="button" value="Search" />
</div>
<div id="map"></div>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->

<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3uH-lMBK_JAGwIVFD48hIrU81CV6lprk&callback=initMap&libraries=&v=weekly"
	async
></script>
<script>

	function initMap() {
		const map = new google.maps.Map(document.getElementById("map"), {
			zoom: 8,
			center: { lat: -34.397, lng: 150.644 },
		});
		const geocoder = new google.maps.Geocoder();
		document.getElementById("submit").addEventListener("click", () => {
			geocodeAddress(geocoder, map);
		});
	}

	function geocodeAddress(geocoder, resultsMap) {
		const address = document.getElementById("address").value;
		geocoder
			.geocode({ address: address })
			.then(({ results }) => {
				resultsMap.setCenter(results[0].geometry.location);
				new google.maps.Marker({
					map: resultsMap,
					position: results[0].geometry.location,
				});
			})
			.catch((e) =>
				alert("Geocode was not successful for the following reason: " + e)
			);
	}
</script>
</body>
</html>

