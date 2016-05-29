<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title></title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.18.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.18.0/mapbox-gl.css' rel='stylesheet' />
    <style>
        body { margin:0; padding:0; }
        #map { position:absolute; top:0; bottom:0; width:100%; }
    </style>
</head>
<body>

<div id='map'></div>
<script>
		mapboxgl.accessToken = 'pk.eyJ1IjoiamltZSIsImEiOiJjaW9zeDdlNmwwMDlndG9tNWE5NmE5M3FiIn0.3e3j-uzVc-1BFZqwMdoNeQ';
		var map = new mapboxgl.Map({
		    container: 'map', // container id
		    style: 'mapbox://styles/mapbox/light-v9', //stylesheet location
		    center: [-84.06446189999997, 9.930139299999999], // starting position
		    zoom: 9 // starting zoom
		});
</script>

</body>
</html>
